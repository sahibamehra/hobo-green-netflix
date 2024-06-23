<?php
include_once __DIR__ . '../../config/MyDatabase.php';

class Serie {
    private $conn;
    private $table_name = "serie";

    public $serieID;
    public $serieTitel;
    public $imdbLink;
    public $actief;
    public $klantNr;

    public function __construct() {
        $database = new MyDatabase();
        $this->conn = $database->createConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET serieID=:serieID, serieTitel=:serieTitel, imdbLink=:imdbLink, actief=:actief";
        
        $stmt = $this->conn->prepare($query);

        $this->serieID = htmlspecialchars(strip_tags($this->serieID));
        $this->serieTitel = htmlspecialchars(strip_tags($this->serieTitel));
        $this->imdbLink = htmlspecialchars(strip_tags($this->imdbLink));
        $this->actief = htmlspecialchars(strip_tags($this->actief));

        $stmt->bindParam(":serieID", $this->serieID);
        $stmt->bindParam(":serieTitel", $this->serieTitel);
        $stmt->bindParam(":imdbLink", $this->imdbLink);
        $stmt->bindParam(":actief", $this->actief);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = "SELECT ser.SerieID as SerieID, ser.IMDBLink as IMDBLink, ser.SerieTitel as SerieTitel, ser.Actief as Actief, GROUP_CONCAT(g.GenreNaam ORDER BY g.GenreNaam SEPARATOR ', ') AS GenreNamen 
        FROM serie ser 
        JOIN serie_genre sg ON ser.SerieID = sg.SerieID 
        JOIN genre g ON sg.GenreID = g.GenreID 
        GROUP BY ser.SerieID, ser.IMDBLink, ser.SerieTitel 
        ORDER BY ser.SerieTitel;   
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    

    public function readActive() {
        $query = "SELECT ser.SerieID as SerieID, ser.IMDBLink as IMDBLink, ser.SerieTitel as SerieTitel, ser.Actief as Actief, GROUP_CONCAT(g.GenreNaam ORDER BY g.GenreNaam SEPARATOR ', ') AS GenreNamen 
        FROM serie ser 
        JOIN serie_genre sg ON ser.SerieID = sg.SerieID 
        JOIN genre g ON sg.GenreID = g.GenreID 
        WHERE ser.Actief = 1 
        GROUP BY ser.SerieID, ser.IMDBLink, ser.SerieTitel 
        ORDER BY ser.SerieTitel;   
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function readActiveEditors() {
        $query = "
        SELECT ser.SerieID as SerieID, ser.IMDBLink as IMDBLink, ser.SerieTitel as SerieTitel, ser.Actief as Actief, GROUP_CONCAT(g.GenreNaam ORDER BY g.GenreNaam SEPARATOR ', ') AS GenreNamen 
        FROM serie ser 
        JOIN serie_genre sg ON ser.SerieID = sg.SerieID 
        JOIN genre g ON sg.GenreID = g.GenreID 
        WHERE ser.Actief = 1 and ser.SerieID in (
        select SerieID from seizoen where IMDBRating > 3
        )
        GROUP BY ser.SerieID, ser.IMDBLink, ser.SerieTitel 
        ORDER BY ser.SerieTitel;";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readActiveTrending() {

        $query = "
        SELECT ser.SerieID as SerieID, ser.IMDBLink as IMDBLink, ser.SerieTitel as SerieTitel, ser.Actief as Actief, GROUP_CONCAT(g.GenreNaam ORDER BY g.GenreNaam SEPARATOR ', ') AS GenreNamen 
        FROM serie ser 
        JOIN serie_genre sg ON ser.SerieID = sg.SerieID 
        JOIN genre g ON sg.GenreID = g.GenreID 
        WHERE ser.Actief = 1 and ser.SerieID in (
        select SerieID from seizoen where IMDBRating > 4
        )
        GROUP BY ser.SerieID, ser.IMDBLink, ser.SerieTitel 
        ORDER BY ser.SerieID;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function readHistory() {
        $KlantNr = $_SESSION['KlantNr'];
        $query = "
        SELECT ser.SerieID as SerieID, ser.IMDBLink as IMDBLink, ser.SerieTitel as SerieTitel, ser.Actief as Actief, GROUP_CONCAT(g.GenreNaam ORDER BY g.GenreNaam SEPARATOR ', ') AS GenreNamen 
        FROM serie ser 
        JOIN serie_genre sg ON ser.SerieID = sg.SerieID 
        JOIN genre g ON sg.GenreID = g.GenreID 
        WHERE ser.SerieID in (SELECT distinct se.SerieID as SerieID
            FROM
                stream s
            JOIN
                aflevering a ON s.AflID= a.AfleveringID
            JOIN
                seizoen se ON a.SeizID = se.SeizoenID
            JOIN
                serie ser ON se.SerieID = ser.SerieID
            where s.KlantID = :KlantNrParam)
        GROUP BY ser.SerieID, ser.IMDBLink, ser.SerieTitel 
        ORDER BY ser.SerieID;";

       
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['KlantNrParam' => $this->klantNr]);
        return $stmt;
    }


    

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET serieTitel = :serieTitel, imdbLink = :imdbLink, actief = :actief WHERE serieID = :serieID";

        $stmt = $this->conn->prepare($query);

        $this->serieID = htmlspecialchars(strip_tags($this->serieID));
        $this->serieTitel = htmlspecialchars(strip_tags($this->serieTitel));
        $this->imdbLink = htmlspecialchars(strip_tags($this->imdbLink));
        $this->actief = htmlspecialchars(strip_tags($this->actief));

        $stmt->bindParam(":serieID", $this->serieID);
        $stmt->bindParam(":serieTitel", $this->serieTitel);
        $stmt->bindParam(":imdbLink", $this->imdbLink);
        $stmt->bindParam(":actief", $this->actief);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE serieID = ?";

        $stmt = $this->conn->prepare($query);

        $this->serieID = htmlspecialchars(strip_tags($this->serieID));

        $stmt->bindParam(1, $this->serieID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function search($keyword) {
        $whereClauseForUser=" AND ser.Actief = 1 ";
        if(isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'Admin' OR $_SESSION['userRole'] == 'CAdmin') ){
            $whereClauseForUser="";
        }

        $query = "SELECT ser.SerieID as SerieID, ser.IMDBLink as IMDBLink, ser.SerieTitel as SerieTitel, ser.Actief as Actief, GROUP_CONCAT(g.GenreNaam ORDER BY g.GenreNaam SEPARATOR ', ') AS GenreNamen 
        FROM serie ser 
        JOIN serie_genre sg ON ser.SerieID = sg.SerieID 
        JOIN genre g ON sg.GenreID = g.GenreID 
        WHERE ser.SerieTitel LIKE ? {$whereClauseForUser}
        GROUP BY ser.SerieID, ser.IMDBLink, ser.SerieTitel 
        ORDER BY ser.SerieTitel;   
        ";

        $stmt = $this->conn->prepare($query);

        $keyword = trim(htmlspecialchars(strip_tags($keyword)));
        $keyword = "%{$keyword}%";

        $stmt->bindParam(1, $keyword);

        $stmt->execute();

        return $stmt;
    }
}
?>
