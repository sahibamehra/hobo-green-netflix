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

<h1>Edit Profile</h1>
    <form action="../../controllers/ProfileController.php?action=update" method="post">
        <label>KlantNr:</label><input type="text" name="klantNr" value="<?php echo $_GET['klantNr']; ?>"><br>
        <label>AboID:</label><input type="text" name="aboID" value="<?php echo $_GET['aboID']; ?>"><br>
        <label>Voornaam:</label><input type="text" name="voornaam" value="<?php echo $_GET['voornaam']; ?>"><br>
        <label>Tussenvoegsel:</label><input type="text" name="tussenvoegsel" value="<?php echo $_GET['tussenvoegsel']; ?>"><br>
        <label>Achternaam:</label><input type="text" name="achternaam" value="<?php echo $_GET['achternaam']; ?>"><br>
        <label>Email:</label><input type="email" name="email" value="<?php echo $_GET['email']; ?>"><br>
        <label>Password:</label><input type="password" name="password" value="<?php echo $_GET['password']; ?>"><br>
        <label>Genre:</label><input type="text" name="genre" value="<?php echo $_GET['genre']; ?>"><br><br>
        <input type="submit" value="Update">
    </form>



<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>





