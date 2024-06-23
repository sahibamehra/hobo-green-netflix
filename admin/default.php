<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hobo Streaming Platform - Home Page</title>
    <link rel="stylesheet" href="../css/default.css">
</head>
<body>
    
<?php include_once __DIR__ . '/../include_header.php'; ?>
<main>
<!-- Main Content goes here - Start -->

    <?php 
    if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
        //valid Admin User
    ?>
            <H1 class="link-button">Welcome to Admin dashboard! </H1>
            <BR><BR>
            <a href="/green-netflix/views/profile/viewProfileList.php" style="color: #92d051;">Manage User Profiles</a></li><BR>
            <a href="/green-netflix/views/serie" style="color: #92d051;">Manage Serie</a>
            <?php     
    }else if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'CAdmin'){
    ?>        
            <H1 class="link-button">Welcome to Content Management Dashboard! </H1>
            <BR><BR>
            <a href="/green-netflix/views/serie" style="color: #92d051;">Manage Serie</a>
    <?php     
    }else{
    ?>        
            <H1 class="link-button">This is Admin dashboard, please login! </H1>
            
            <script>
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "formSpType");
                input.setAttribute("value", "admin");
                input.setAttribute("id", "login_form_adminForm");
                document.getElementById("login_form").appendChild(input);
            </script>

    <?php     
    }
    ?>        

    <!-- Main Content goes here - End -->
</main>
<?php include_once __DIR__ . '/../include_sidebar.php'; ?>
</body>
</html>
