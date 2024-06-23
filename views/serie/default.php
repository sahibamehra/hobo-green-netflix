<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Series</title>
    <link rel="stylesheet" href="./../../css/default.css">
</head>
<body>
<?php include_once __DIR__ . '/../../include_header.php'; ?>
<main>
<!-- Main Content goes here - Start -->
<h1>Series List</h1>


        <?php 
        if(isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'Admin' OR $_SESSION['userRole'] == 'CAdmin') ){
            //valid Admin User
        ?>
            <a href="create.php"class="link-button"><b>Create New Serie</b></a>
        <?php     
        }
        ?>            
                <table class='item-container2'>
                    <thead>
                        <tr>
                            <th colspan=2><h3>Filter Data</h3></th>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <th>Genre Namen</th>
                        </tr>
                        <tr>
                            <th><input type="text" id="filterTitle" placeholder="Filter Title" onkeyup="filterUsers()"></th>
                            <th><input type="text" id="filterGenreNamen" placeholder="Filter Genre Namen" onkeyup="filterUsers()"></th>
                        </tr>
                    </thead>
                </table>

        <?php
        include_once '../../controllers/SerieController.php';

        $controller = new SerieController();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['keyword'])) {
            $series = $controller->search();
        }else if(isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'Admin' OR $_SESSION['userRole'] == 'CAdmin') ){
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

            echo "
                <table id='series-list' class='item-container'>
                    <tr style='display:none' id='series-row-data'><td>{$SerieTitel}</td><td>{$GenreNamen}</td></tr>
                    <tr>
                        <td rowspan=2>
                            <a target='_new' href='{$IMDBLink}' class='link-button'><img src='{$imagePath}' width='180' height='220' onerror='this.onerror=null;this.src=\"./images/error.png\";'></a>               
                        </td>
                        <td>
                            <p><h2 >{$SerieTitel}<br><br></h2></p>
                            <p>{$GenreNamen}</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><a target='_new' href='{$IMDBLink}' class='link-button'>IMDB Link</a> </p>

                ";
                //show ONLY to admin
                if(isset($_SESSION['userRole']) && ($_SESSION['userRole'] == 'Admin' OR $_SESSION['userRole'] == 'CAdmin') ){
                    //valid Admin User

                    if($Actief > 0){
                        $isActiveStatus="Yes";
                    }else{
                        $isActiveStatus="No";
                    }

                    echo "
                        <p class='item-text1'>Active: {$isActiveStatus}</p>
                        <a href='edit.php?serieID={$SerieID}&serieTitel={$SerieTitel}&imdbLink={$IMDBLink}&actief={$Actief}' class='edit-btn' role='button'>Edit</a>
                        <form action='../../controllers/SerieController.php?action=delete' method='post' style='display:inline;'>
                            <input type='hidden' name='serieID' value='{$SerieID}'>
                            <input type='submit' value='Delete' class='del-btn' role='button'>
                        </form>
                    
                    ";
                
                }

                echo "
                </td>
                </tr></table>
                ";

        }
        ?>
    
    <script>

        // Function to search for a string in all tables with the same ID
        function searchInTables(searchString) {

        }

          function filterUsers() {
            const filterTitleValue = document.getElementById('filterTitle').value.toLowerCase();
            const filterGenreNamenValue = document.getElementById('filterGenreNamen').value.toLowerCase();

            //searchInTables(filterName);
            // Get all tables with the ID 'series-list'
            const tables = document.querySelectorAll('#series-list');

            // Loop through each table
            tables.forEach(table => {
                // Get all the cells in the current table
                const cells = table.getElementsByTagName('td');
                //console.log('Data - SerieTitel:', table.rows[0].cells[0].textContent);
                data_filterTitle=table.rows[0].cells[0].textContent.toLowerCase();
                data_filterGenreNamen=table.rows[0].cells[1].textContent.toLowerCase();
                
                
                if (data_filterTitle.includes(filterTitleValue) && data_filterGenreNamen.includes(filterGenreNamenValue)) {
                    //console.log('Data - SerieTitel:', tableTrTdData);
                    table.style.display = '';
                }else{
                    table.style.display = 'none';
                }


            });

        }
    </script>

<!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>










