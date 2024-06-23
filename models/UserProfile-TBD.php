<?php
//namespace MyNetflix\Models;


class Profile {
    
    
    private $klantNr;
    private $AboID;
    private $voornaam;
    private $tussenvoegsel;
    private $achternaam;
    private $email;
    private $password;
    private $genre;

    public function __construct($klantNr, $AboID, $voornaam, $tussenvoegsel, $achternaam, $email, $password, $genre) {
        $this->klantNr = $klantNr;
        $this->AboID = $AboID;
        $this->voornaam = $voornaam;
        $this->tussenvoegsel = $tussenvoegsel;
        $this->achternaam = $achternaam;
        $this->email = $email;
        $this->password = $password;
        $this->genre = $genre;
    }

    // Getters
    public function getKlantNr() {
        return $this->klantNr;
    }

    public function getAboID() {
        return $this->AboID;
    }

    public function getVoornaam() {
        return $this->voornaam;
    }

    public function getTussenvoegsel() {
        return $this->tussenvoegsel;
    }

    public function getAchternaam() {
        return $this->achternaam;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGenre() {
        return $this->genre;
    }

    // Setters
    public function setAboID($AboID) {
        $this->AboID = $AboID;
    }

    public function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    public function setTussenvoegsel($tussenvoegsel) {
        $this->tussenvoegsel = $tussenvoegsel;
    }

    public function setAchternaam($achternaam) {
        $this->achternaam = $achternaam;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }
}

?>