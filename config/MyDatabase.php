<?php
//namespace MyNetflix\Database;

//use Mysqli;

class MyDatabase{

    private $servername = null;
    private $username = null;
    private $password = null;
    private $schema = null;

    public $conn;

    public function __construct()
    {
        $this->servername = "localhost:3306";
        $this->username = "root";
        $this->password = "";
        $this->schema = "hobo2022";
    }

    // Function to return valid connection
    public function createConnection() {

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->schema, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>