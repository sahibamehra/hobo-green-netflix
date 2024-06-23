<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profiles</title>
    <link rel="stylesheet" href="../../css/default.css">

</head>
<body>
<?php include_once __DIR__ . '/../../include_header.php'; ?>
<!-- Main Content goes here - Start -->
<main>
    <h1>Profile List! </h1><br>
    <a href="create.php" target="_blank" class="link-button"><b>Create New Profile</b></a>
    <table border="1" style="border-color: white; text-align:center">
        <tr style="color:#92d051;">
            <th>KlantNr</th>
            <th>AboID</th>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Password</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>

        <?php
            include_once __DIR__ . '/../../controllers/ProfileController.php';
            

            //use MyNetflix\User\ProfileController as ProfileController;

            $controller = new ProfileController();
            $profiles = $controller->read();
            
            while ($row = $profiles->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                
                echo "<tr>
                    <td>{$KlantNr}</td>
                    <td>{$AboID}</td>
                    <td>{$Voornaam}</td>
                    <td>{$Tussenvoegsel}</td>
                    <td>{$Achternaam}</td>
                    <td>{$Email}</td>
                    <td>{$password}</td>
                    <td>{$Genre}</td>
                    <td>
                        <a href='edit.php?klantNr={$KlantNr}&aboID={$AboID}&voornaam={$Voornaam}&tussenvoegsel={$Tussenvoegsel}&achternaam={$Achternaam}&email={$Email}&password={$password}&genre={$Genre}' class='edit-btn' role='button'>Edit</a>
                        <form action='../../controllers/ProfileController.php?action=delete' method='post' style='display:inline;'>
                            <input type='hidden' name='klantNr' value='{$KlantNr}'>
                            <input type='submit' value='Delete' class='del-btn' role='button'>
                        </form>
                    </td>
                </tr>";
            }
        ?>

    </table>
<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>


