<?php
include_once __DIR__ . '../../config/MyDatabase.php';
include_once __DIR__ . '../../models/Profile.php';


class UserController {
    private $db;
    private $profile;

    public function __construct() {
        $database = new MyDatabase();
        $this->db = $database->createConnection();
        $this->profile = new Profile($this->db);
    }
    public function login() {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new Exception('Method Not Allowed', 405);
            }

            $data = json_decode(file_get_contents('php://input'), true);


            if (!isset($data['username']) || !isset($data['password'])) {
                //throw new Exception('Invalid input', 400);
                $username = "";
                $password = "";
    
            }else{
                $username = $data['username'];
                $password = $data['password'];
            }

            if (isset($data['formSpType']) && $data['formSpType'] === "Y"){
                //admin login
                $user = $this->profile->getAdminUser($username, $password);

                if ($user) {
                    $_SESSION['name'] = $user['username']; // . " " . $user['Achternaam'];
                    if($username == "admin"){
                        $_SESSION['userRole'] = "Admin"; // Admin
                    }else{
                        $_SESSION['userRole'] = "CAdmin"; // content admin
                    }
                    
                    echo json_encode(['status' => 'success', 'message' => 'Login successful', 'user' => $user['username']]);
                }
            }else{
                //normal user login
                $user = $this->profile->getUser($username, $password);

                if ($user) {
                    $_SESSION['name'] = $user['Voornaam']; // . " " . $user['Achternaam'];
                    $_SESSION['user'] = $user['Email'];
                    $_SESSION['KlantNr'] = $user['KlantNr'];
                    $_SESSION['userRole'] = "User"; // Normal User
                    echo json_encode(['status' => 'success', 'message' => 'Login successful', 'user' => $user['Email'], 'KlantNr' => $user['KlantNr']]);
                } else {
                    throw new Exception('Invalid credentials', 401);
                }
    
            }

        } catch (Exception $e) {
            http_response_code($e->getCode() ? $e->getCode() : 500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function welcome() {
        try {
            if (!isset($_SESSION['user'])) {
                throw new Exception('Not logged in', 401);
            }

            echo json_encode(['status' => 'success', 'message' => 'Welcome', 'user' => $_SESSION['user']]);
        } catch (Exception $e) {
            http_response_code($e->getCode() ? $e->getCode() : 500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function logout() {
        try {
            session_destroy();
            echo json_encode(['status' => 'success', 'message' => 'Logged out']);
        } catch (Exception $e) {
            http_response_code($e->getCode() ? $e->getCode() : 500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
?>
