
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Series</title>
    <link rel="stylesheet" href="../../css/default.css">
</head>
<body>

<?php include_once __DIR__ . '/../../include_header.php'; ?>
<main>
<h1>Search Results</h1>

<form method="post" action="">
    <label for="keyword">Keyword:</label>
    <input type="text" id="keyword" name="keyword" value="<?php echo isset($_POST['keyword']) ? $_POST['keyword'] : ''; ?>">
    
    <label for="genre">Select Genre:</label>
    <select id="genre" name="genre">
        <option value="">-- All Genres --</option>
        <?php
        include_once '../../controllers/SerieController.php';
        $controller = new SerieController();
        $genres = $controller->getGenres();
        foreach ($genres as $genre) {
            $selected = (isset($_POST['genre']) && $_POST['genre'] == $genre['GenreID']) ? 'selected' : '';
            echo "<option value='{$genre['GenreID']}' {$selected}>{$genre['GenreNaam']}</option>";
        }
        ?>
    </select>
    
    <button type="submit">Search</button>
</form>

<table border="1" style="border-color: white;">
    <tr style="color:#92d051;">
        <th>&nbsp;</th>
        <th>Serie Titel</th>
        <th>IMDB Link</th>
    </tr>
    <?php
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

</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>
