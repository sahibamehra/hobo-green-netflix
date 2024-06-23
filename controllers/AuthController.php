<?php
namespace MyNetflix\Controllers;

require_once __DIR__ . "/../Utils/MyDatabase.php";

use MyNetflix\Utils\MyDatabase;

 class AuthController {

    
    private $db = null;
    private $requestMethod;
    private $userId;

    public function __construct($requestMethod, $userId)
    {
        $this->db = new MyDatabase();
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $response = $this->getUser($this->userId);
                } else {
                    $response = $this->getAllUsers();
                };
                break;
            case 'POST':
                $response = $this->createUserFromRequest();
                break;
            case 'PUT':
                $response = $this->updateUserFromRequest($this->userId);
                break;
            case 'DELETE':
                $response = $this->deleteUser($this->userId);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    // Function to get max user ID
    public function login() {
        //set default max pid
        $maxpid=0;

        //create SQL statement
        $sql = "select max(id) as uid from users;";

        

        //open connectionll
        $connection = $this->db -> createConnection();

        //Execute SQL to get results
        $result = $connection->query($sql);

        //Check if results have any rows
        if ($result->num_rows > 0) {
            //get first row
            $row = $result->fetch_assoc();
            //read variable
            $maxpid = $row["uid"];
        }

        //close connection
        $connection->close();
        
        return $maxpid;
    }

  }  ///////////////////////////////////////////////////////////////////////

  ?>
