<?php //session_start(); ?>  
<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hobo Streaming Platform - Home Page</title>
    <link rel="stylesheet" href="./css/default.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/carousel.css">
    <script src="./js/carousel.js"></script>
</head>
<body>
    
<?php include_once __DIR__ . '/include_header.php'; ?>
<main>
<!-- Main Content goes here - Start -->

    <div class="myNetflix-carousel">
        <div class="myNetflix-carousel-inner" id="myNetflix-carousel-inner">
            <!-- Slides will be inserted here -->
        </div>
        <div class="myNetflix-controls">
            <div class="myNetflix-control" id="myNetflix-prev">&lt;</div>
            <div class="myNetflix-control" id="myNetflix-next">&gt;</div>
        </div>
    </div>



<!-- SAHIBA CODE <> SAHIBA CODE <> SAHIBA CODE <> SAHIBA CODE <> SAHIBA CODE <> SAHIBA CODE <> SAHIBA CODE <>  -->

<?php
    $showHideHistory='style="display:none"';
    if(isset($_SESSION['user'])){
        $showHideHistory='style=""';
    }
?>

        <div class="category" <?php echo $showHideHistory; ?> >
            <h3>Last Watched</h3>

            <div class="myNetflix-carousel">
                <div class="myNetflix-carousel-inner" id="myNetflix-carousel-inner-history">
                    <!-- Slides will be inserted here -->
                </div>
                <div class="myNetflix-controls">
                    <div class="myNetflix-control" id="myNetflix-prev-history">&lt;</div>
                    <div class="myNetflix-control" id="myNetflix-next-history">&gt;</div>
                </div>
            </div>
        </div>

        <div class="category">
            <h3>Now Trending</h3>
            <div class="myNetflix-carousel">
                <div class="myNetflix-carousel-inner" id="myNetflix-carousel-inner-trending">
                    <!-- Slides will be inserted here -->
                </div>
                <div class="myNetflix-controls">
                    <div class="myNetflix-control" id="myNetflix-prev-trending">&lt;</div>
                    <div class="myNetflix-control" id="myNetflix-next-trending">&gt;</div>
                </div>
            </div>
        </div>

        <div class="category">
            <h3>Editor's Pick</h3>
            <div class="myNetflix-carousel">
                <div class="myNetflix-carousel-inner" id="myNetflix-carousel-inner-editor">
                    <!-- Slides will be inserted here -->
                </div>
                <div class="myNetflix-controls">
                    <div class="myNetflix-control" id="myNetflix-prev-editor">&lt;</div>
                    <div class="myNetflix-control" id="myNetflix-next-editor">&gt;</div>
                </div>
            </div>

        </div>

<!-- Main Content goes here - End -->        
    </main>
    
<?php include_once __DIR__ . '/include_sidebar.php'; ?>

</body>
</html>