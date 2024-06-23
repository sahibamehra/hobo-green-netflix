<?php session_start(); ?>  
<?php
        include_once './controllers/SerieController.php';

        $controller = new SerieController();
        $series = $controller->readActive();

        if (isset($_GET['action'])){
            $action = $_GET["action"];
            if($action === "history"){
                $series = $controller->readHistory();
            }else if($action === "trending"){
                $series = $controller->readActiveTrending();
            }else if($action === "editor"){
                $series = $controller->readActiveEditors();
            }
        }

        //$series = $controller->readActive();
        
        $carouselData = [];

        while ($row = $series->fetch(PDO::FETCH_ASSOC)) {
            extract($row); //get data into array
            $carouselData[] = $row;
        }

        // Output JSON
        header('Content-Type: application/json');
        echo json_encode($carouselData);

?>
