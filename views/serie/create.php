<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Series</title>
    <link rel="stylesheet" href="../../css/default.css">
</head>
<body>
    
<?php include_once __DIR__ . '/../../include_header.php'; ?>
<main>
<!-- Main Content goes here - Start -->
<h1>Create Serie</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../../controllers/SerieController.php';
    $controller = new SerieController();
    if(isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'Admin' OR $_SESSION['userRole'] == 'CAdmin') ){
        $series = $controller->create();
    }else{
        //
        echo "Invalid request. Please re-login and try again!";
    }

}else{
?>


    <form action="./create.php" method="post">
        <label>SerieID:</label><input type="text" name="serieID"><br>
        <label>Serie Titel:</label><input type="text" name="serieTitel"><br>
        <label>IMDB Link:</label><input type="text" name="imdbLink"><br>
        <label>Actief:</label><input type="checkbox" name="actief"><br>
        <input type="submit" value="Create">
    </form>
    <?php
}
?>
<!-- Main Content goes here - End -->

</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>




