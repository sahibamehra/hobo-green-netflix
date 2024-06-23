<?php
include_once __DIR__ . '../../models/Profile.php';
include_once __DIR__ . '../../models/History.php';


class ProfileController {
    private $profile;
    private $history;

    public function __construct() {
        $this->profile = new Profile();
        $this->history = new History();
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->profile->klantNr = $_POST['klantNr'];
            $this->profile->AboID = $_POST['AboID'];
            $this->profile->voornaam = $_POST['voornaam'];
            $this->profile->tussenvoegsel = $_POST['tussenvoegsel'];
            $this->profile->achternaam = $_POST['achternaam'];
            $this->profile->email = $_POST['email'];
            $this->profile->password = $_POST['password'];
            $this->profile->genre = $_POST['genre'];

            if ($this->profile->create()) {
                header("Location: ../views/profile");
            } else {
                echo "Profile could not be created.";
            }
        }
    }

    public function read() {
        return $this->profile->read();
    }

    public function getMyProfile() {
        if(isset($_SESSION['KlantNr'])){
            $this->profile->klantNr = $_SESSION['KlantNr'];
        }
        
        return $this->profile->getMyProfile();
    }


    public function update() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->profile->klantNr = $_POST['klantNr'];
            $this->profile->AboID = $_POST['AboID'];
            $this->profile->voornaam = $_POST['voornaam'];
            $this->profile->tussenvoegsel = $_POST['tussenvoegsel'];
            $this->profile->achternaam = $_POST['achternaam'];
            $this->profile->email = $_POST['email'];
            $this->profile->password = $_POST['password'];
            $this->profile->genre = $_POST['genre'];

            if ($this->profile->update()) {
                header("Location: ../views/profile");
                //echo "Profile could not be updated.";
            } else {
                echo "Profile could not be updated.";
            }
        }
    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->profile->klantNr = $_POST['klantNr'];

            if ($this->profile->delete()) {
                header("Location: ../views/profile");
            } else {
                echo "Profile could not be deleted.";
            }
        }
    }

    public function getMyHistory() {
        if(isset($_SESSION['KlantNr'])){
            $this->history->klantNr = $_SESSION['KlantNr'];
        }

        return $this->history->getMyHistory();
    }


}
?>
