<?php

include_once __DIR__ . '/../../controllers/UserController.php';
include_once __DIR__ . '/../../models/Profile.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if($_GET["action"] == 'getuser' && isset($_SESSION['name'])){
        echo json_encode(['status' => 'success', 'message' => 'User Logged In', 'user' => $_SESSION['name']]);
    }else{
        echo json_encode(['status' => 'success', 'message' => 'LoggedOut']);
    }

    if($_GET["action"] == 'logout'){
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
        //echo json_encode(['status' => 'success', 'message' => 'LoggedOut']);
        //$strResponse='{"status":"success", "message":"LoggedOut"}';
        //echo json_encode($strResponse);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Login
    $username = 'your_username';
    $password = 'your_password';


    $userController = new UserController();
    $userController->login();
}




//$request = $_SERVER['REQUEST_URI'];
/*
switch ($request) {
    case '/login':
        $userController->login();
        break;
    case '/welcome':
        $userController->welcome();
        break;
    case '/logout':
        $userController->logout();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
        break;
}
*/
?>
