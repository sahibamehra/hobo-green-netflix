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
    <h1>History</h1><br>
    <table width="80%" border="1" style="border-color: white; text-align:center">
        <tr style="color:#92d051;">
            <th style="padding:5px;">SerieTitel</th>
            <th style="padding:5px;">AflTitel</th>
            <th style="padding:5px;">Rang</th>
            <th style="padding:5px;">Jaar</th>
            <th style="padding:5px;">IMDBRating</th>
            <th style="padding:5px;">StreamID</th>
            <th style="padding:5px;">Start Date</th>
            <th style="padding:5px;">End Date</th>
            <th style="padding:5px;">Duration</th>
        </tr>

        <?php
            include_once __DIR__ . '/../../controllers/ProfileController.php';
            

            //use MyNetflix\User\ProfileController as ProfileController;

            $controller = new ProfileController();
            $profiles = $controller->getMyHistory();
            
            while ($row = $profiles->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $starttime = strtotime($SDate); // convert to timestring
                $endtime = strtotime($EDate); // convert to timestring
                $diff = ($endtime - $starttime)/60; // do the math -- minutes


                echo "<tr>
                    <td>{$SerieTitel}</td>
                    <td>{$AflTitel}</td>
                    <td>{$Rang}</td>
                    <td>{$Jaar}</td>
                    <td>{$IMDBRating}</td>
                    <td>{$StreamID}</td>
                    <td>{$SDate}</td>
                    <td>{$EDate}</td>
                    <td>{$diff} minutes</td>
                </tr>";
            }
        ?>

    </table>
<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>


