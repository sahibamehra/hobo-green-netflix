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
    <h1>Edit Profile</h1>
    
        <?php
            include_once __DIR__ . '/../../controllers/ProfileController.php';
            

            //use MyNetflix\User\ProfileController as ProfileController;
            $KlantNrVal=0;
            if(isset($_SESSION['KlantNr'])){
                $KlantNrVal=$_SESSION['KlantNr'];
            }

            

            $controller = new ProfileController();
            $profiles = $controller->getMyProfile();
          
            //$row = $profiles->fetch(PDO::FETCH_ASSOC);

            while ($row = $profiles->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                ?>
                    <form action="../../controllers/ProfileController.php?action=update" method="post">
                    <label>KlantNr:</label><input type="text" name="klantNr" value="<?php echo $KlantNr; ?>"><br>
                    <label>AboID:</label><input type="text" name="aboID" value="<?php echo $AboID; ?>"><br>
                    <label>Voornaam:</label><input type="text" name="voornaam" value="<?php echo $Voornaam; ?>"><br>
                    <label>Tussenvoegsel:</label><input type="text" name="tussenvoegsel" value="<?php echo $Tussenvoegsel; ?>"><br>
                    <label>Achternaam:</label><input type="text" name="achternaam" value="<?php echo $Achternaam; ?>"><br>
                    <label>Email:</label><input type="email" name="email" value="<?php echo $Email; ?>"><br>
                    <label>Password:</label><input type="password" name="password" value="<?php echo $password; ?>"><br>
                    <label>Genre:</label>
                    <!-- <input type="text" name="genre" value="<?php echo $Genre; ?>"><br><br> -->
                        <select id="genre" name="genre">
                        <option value="2">Science Fiction</option>
                        <option value="3">Horror</option>
                        <option value="4">Historical</option>
                        <option value="5">Crime</option>
                        <option value="6">Drama</option>
                        <option value="7">Fantasy</option>
                        <option value="8">Romance</option>
                        <option value="9">Detective</option>
                        <option value="10">Teen</option>
                        <option value="11">Comedy</option>
                        <option value="12">Satire</option>
                        <option value="13">Coming of Age</option>
                        <option value="14">Biopic</option>
                        <option value="15">Suspense</option>
                        <option value="16">Children</option>
                        <option value="17">Adventure</option>
                        <option value="18">Supernatural</option>
                        <option value="19">Thriller</option>
                        <option value="20">Docu</option>
                        <option value="21">Art</option>
                        <option value="22">Culinary</option>
                        <option value="23">True Crime</option>
                        <option value="24">Superhero</option>
                        <option value="25">Political</option>
                        <option value="26">Travel</option>
                        <option value="27">Cooking</option>
                        <option value="28">Drug</option>
                        <option value="29">Lifestyle</option>
                        <option value="30">Sports</option>
                        </select>

                    <input type="submit" value="Update">
                </form>
        <?php
            }
            ?>

<br>
<a href="./"><div class="link-button">Manage Profile Settings</div></a>


<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>


