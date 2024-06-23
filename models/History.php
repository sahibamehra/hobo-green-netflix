<?php
//namespace MyNetflix\User;

include_once __DIR__ . '../../config/MyDatabase.php';


class History {

    private $conn;
    
    public $klantNr;
    public $KlantID;
    public $SerieTitel;
    public $AflTitel;
    public $SerieID;
    public $Rang;
    public $Jaar;
    public $IMDBRating;
    public $StreamID;
    public $SDate;
    public $EDate;

    public function __construct() {
        $database = new MyDatabase();
        $this->conn = $database->createConnection();
    }

    public function getMyHistory() {

        $sql = "
        SELECT s.KlantID, ser.SerieTitel, a.AflTitel, se.SerieID, se.Rang, se.Jaar, se.IMDBRating, s.StreamID, s.d_start as SDate, s.d_eind as EDate
            FROM
                hobo2022.stream s
            JOIN
                aflevering a ON s.AflID= a.AfleveringID
            JOIN
                seizoen se ON a.SeizID = se.SeizoenID
            JOIN
                serie ser ON se.SerieID = ser.SerieID
            where s.KlantID = :KlantNrParam
            Order By 
                s.KlantID, ser.SerieTitel, s.d_start
        ";
// SELECT
//      s.KlantID, ser.SerieTitel, a.AflTitel, se.SerieID, se.Rang, se.Jaar, se.IMDBRating, s.StreamID, s.d_start as SDate, s.d_eind as EDate, SUM(TIMESTAMPDIFF(SECOND, s.d_start, s.d_eind)) AS TotalWatchTimeSeconds
// FROM
//      hobo2022.stream s
// JOIN
//      aflevering a ON s.AflID= a.AfleveringID
// JOIN
//      seizoen se ON a.SeizID = se.SeizoenID
// JOIN
//      serie ser ON se.SerieID = ser.SerieID
//       where s.KlantID = :KlantNrParam
// ORDER BY
//      TotalWatchTimeSeconds DESC;

        $this->klantNr = htmlspecialchars(strip_tags($this->klantNr));
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['KlantNrParam' => $this->klantNr]);

        return $stmt;
    }

}