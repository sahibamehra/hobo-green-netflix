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
<h1>Series List</h1>

<?php 
        if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
            //valid Admin User
        ?>
            <a href="create.php"class="link-button"><b>Create New Serie</b></a>
        <?php     
        }
        ?>            


    
    
    <table border="1" style="border-color: white;">
        <tr style="color:#92d051;">

            <th>Serie Titel</th>
            <th>Poster/IMDB Link</th>

            <?php 
            if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
                //valid Admin User
            ?>
            <th>Actions</th>
            <?php     
            }
            ?>            
            
        </tr>

        <?php
        include_once '../../controllers/SerieController.php';
        

        $controller = new SerieController();
        if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
            $series = $controller->read();
        }else{
            $series = $controller->readActive();
        }
        
        while ($row = $series->fetch(PDO::FETCH_ASSOC)) {


            extract($row); //get data into array

            $serieIDPadded = str_pad($SerieID, 5, '0', STR_PAD_LEFT); // Pad the serieID with zeros to make it 5 digits
            $imagePath = "../../images/" . $serieIDPadded . ".jpg"; // Image path format

            if(!file_exists($imagePath)){
                // Image not found
                $imagePath = "../../images/error.png"; 
            }

            echo "<tr>

                <td>{$SerieTitel}</td>
                <td><a target='_new' href='{$IMDBLink}' class='link-button'><img src='{$imagePath}' width='180' height='220'></a></td>

                ";
                
                //show ONLY to admin
                if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
                    //valid Admin User
                    echo "
                    <td>
                        <a href='edit.php?serieID={$SerieID}&serieTitel={$SerieTitel}&imdbLink={$IMDBLink}&actief={$Actief}' class='edit-btn' role='button'>Edit</a>
                        <form action='../../controllers/SerieController.php?action=delete' method='post' style='display:inline;'>
                            <input type='hidden' name='serieID' value='{$SerieID}'>
                            <input type='submit' value='Delete' class='del-btn' role='button'>
                        </form>
                    </td>
                    ";
                }


            echo "</tr>";


        }
        ?>
    </table>


<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>










