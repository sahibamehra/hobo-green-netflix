<?php
//namespace MyNetflix\User;

include_once __DIR__ . '../../config/MyDatabase.php';

class Profile {
    private $conn;
    private $table_name = "klant";

    public $klantNr;
    public $AboID;
    public $voornaam;
    public $tussenvoegsel;
    public $achternaam;
    public $email;
    public $password;
    public $genre;
    public $adminLogin;

    public function __construct() {
        $database = new MyDatabase();
        $this->conn = $database->createConnection();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET
                    klantNr=:klantNr, AboID=:AboID, voornaam=:voornaam, tussenvoegsel=:tussenvoegsel, achternaam=:achternaam, email=:email, password=:password, genre=:genre";
        
        $stmt = $this->conn->prepare($query);

        $this->klantNr = htmlspecialchars(strip_tags($this->klantNr));
        $this->AboID = htmlspecialchars(strip_tags($this->AboID));
        $this->voornaam = htmlspecialchars(strip_tags($this->voornaam));
        $this->tussenvoegsel = htmlspecialchars(strip_tags($this->tussenvoegsel));
        $this->achternaam = htmlspecialchars(strip_tags($this->achternaam));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->genre = htmlspecialchars(strip_tags($this->genre));

        $stmt->bindParam(":klantNr", $this->klantNr);
        $stmt->bindParam(":AboID", $this->AboID);
        $stmt->bindParam(":voornaam", $this->voornaam);
        $stmt->bindParam(":tussenvoegsel", $this->tussenvoegsel);
        $stmt->bindParam(":achternaam", $this->achternaam);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":genre", $this->genre);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET
                    AboID = :AboID,
                    voornaam = :voornaam,
                    tussenvoegsel = :tussenvoegsel,
                    achternaam = :achternaam,
                    email = :email,
                    password = :password,
                    genre = :genre
                  WHERE klantNr = :klantNr";

        $stmt = $this->conn->prepare($query);

        $this->AboID = htmlspecialchars(strip_tags($this->AboID));
        $this->voornaam = htmlspecialchars(strip_tags($this->voornaam));
        $this->tussenvoegsel = htmlspecialchars(strip_tags($this->tussenvoegsel));
        $this->achternaam = htmlspecialchars(strip_tags($this->achternaam));
        $this->email = $this->email;
        $this->password = $this->password;
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->klantNr = $this->klantNr;

        $stmt->bindParam(":AboID", $this->AboID);
        $stmt->bindParam(":voornaam", $this->voornaam);
        $stmt->bindParam(":tussenvoegsel", $this->tussenvoegsel);
        $stmt->bindParam(":achternaam", $this->achternaam);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":klantNr", $this->klantNr);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE klantNr = ?";
        
        $stmt = $this->conn->prepare($query);
        
        $this->klantNr = htmlspecialchars(strip_tags($this->klantNr));
        
        $stmt->bindParam(1, $this->klantNr);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    public function getUser($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE email = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->fetch();
    }

    public function getAdminUser($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        return $stmt->fetch();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readActive() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getMyProfile() {
        $this->klantNr = htmlspecialchars(strip_tags($this->klantNr));
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE KlantNr = :KlantNrParam");
        $stmt->execute(['KlantNrParam' => $this->klantNr]);

        return $stmt;
    }




}
?>