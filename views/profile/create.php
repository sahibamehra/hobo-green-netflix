<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profiles</title>
    <link rel="stylesheet" href="../../css/default.css">
</head>
<body>
<?php include_once __DIR__ . '/../../include_header.php'; ?>
<main>
<!-- Main Content goes here - Start -->

 
<h1>Create Profile</h1>
    <form action="../../src/User/ProfileController.php?action=create" method="post">
        <label>KlantNr:</label><input type="text" name="klantNr"><br>
        <label>AboID:</label><input type="text" name="aboID"><br>
        <label>Voornaam:</label><input type="text" name="voornaam"><br>
        <label>Tussenvoegsel:</label><input type="text" name="tussenvoegsel"><br>
        <label>Achternaam:</label><input type="text" name=""><br>

<input type="submit" value="Create">
    </form>



<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>







