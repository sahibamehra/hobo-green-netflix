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
<h1>Search Results</h1>

    <table border="1" style="border-color: white;">
        <tr style="color:#92d051;">
            <th>&nbsp;</th>
            <th>Serie Titel</th>
            <th>IMDB Link</th>

        </tr>
        <?php
        include_once '../../controllers/SerieController.php';
        $controller = new SerieController();
        $series = $controller->search();

        
        if ($series) {
            while ($row = $series->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $paddedId = sprintf('%05d', $SerieID);
                echo "<tr>
                    <td style='text-align:center'>
                    <img src='./../../images/{$paddedId}.jpg' class='movie-image-small' onerror='this.onerror=null;this.src=\"./../../images/error.png\";'>
                    </td>
                    <td>{$SerieTitel}</td>
                    <td><a target='_new' href='{$IMDBLink}' class='link-button'>IMDB Link</a></td>
                </tr>";
            }
        }
        ?>
    </table>
<!-- Main Content goes here - End -->

</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>

