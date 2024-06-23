<?php
include_once __DIR__ .'../../models/Serie.php';

class SerieController {
    private $serie;

    public function __construct() {
        $this->serie = new Serie();
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->serie->serieID = $_POST['serieID'];
            $this->serie->serieTitel = $_POST['serieTitel'];
            $this->serie->imdbLink = $_POST['imdbLink'];
            if(isset($_POST['actief'])){
                $this->serie->actief = 1;
            }else{
                $this->serie->actief = 0;
            }

            if ($this->serie->create()) {
                header("Location: ../views/serie/index.php");
            } else {
                echo "Serie could not be created.";
            }
        }
    }

    public function read() {
        return $this->serie->read();
    }

    public function readActive() {
        return $this->serie->readActive();
    }

    public function readActiveEditors() {
        return $this->serie->readActiveEditors();
    }

    public function readActiveTrending() {
        return $this->serie->readActiveTrending();
    }

    

    public function readHistory() {
        if (!isset($_SESSION['user'])) {
            throw new Exception('Not logged in', 401);
        }

        if(isset($_SESSION['KlantNr'])){
            $this->serie->klantNr = $_SESSION['KlantNr'];
        }

        return $this->serie->readHistory();
    }

    public function update() {
        //echo "Serie could not be updated.";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->serie->serieID = $_POST['serieID'];
            $this->serie->serieTitel = $_POST['serieTitel'];
            $this->serie->imdbLink = $_POST['imdbLink'];
            if(isset($_POST['actief'])){
                $this->serie->actief = 1;
            }else{
                $this->serie->actief = 0;
            }
            

            if ($this->serie->update()) {
                //header("Location: /green-netflix/views/serie/");
                echo "Serie updated!";
            } else {
                echo "Serie could not be updated.";
            }
        }

    }

    public function delete() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Delete not allowed
            echo "Serie could not be deleted.";
            
            // $this->serie->serieID = $_POST['serieID'];

            // if ($this->serie->delete()) {
            //     header("Location: ../views/serie/index.php");
            // } else {
            //     echo "Serie could not be deleted.";
            // }
            
        }
    }

    public function search() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keyword'])) {
            $keyword = trim($_POST['keyword']);
            return $this->serie->search($keyword);
        }
        return null;
    }
}
?>
