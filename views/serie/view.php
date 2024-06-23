<!-- Common Content goes here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Series</title>
    <link rel="stylesheet" href="./../../css/default.css">

    <style>
      body{
      padding-top: 1%;}
        * {
        box-sizing: border-box;
        }

        /* Create two unequal columns that floats next to each other */
        .column {
        float: left;
        padding: 10px;
        height: 300px; /* Should be removed. Only for demonstration */
        }

        .left {
        width: 15%;
        }

        .right {
        width: 85%;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }
    </style>

</head>
<body>
    
<?php include_once __DIR__ . '/../../include_header.php'; ?>
<main>
<!-- Main Content goes here - Start -->

<?php 

        $loggedInUser=false;
    if(isset($_SESSION['userRole'])){
        $loggedInUser=true;
    }

?>

<?php if($loggedInUser){ ?>
    <h1>Click to play-- <?php echo $_GET['serieTitel']; ?></h1>
    <div class="row">
  <div class="column left" >
  <img onclick="playPause()" style="cursor:pointer;" class='movie-image-small' src="./../../images/<?php echo $_GET['paddedId']; ?>.jpg" onerror="this.onerror=null;this.src='./../../images/error.png';">
  <BR><BR>
<a target ="_new" class="link-button" href="<?php echo $_GET['imdbLink']; ?>">IMDB Link</a>
  </div>
  <div class="column right" >
<p style="padding-left:10%; width: 80%; height: 100px;">
  Join Phil Rosenthal, the lovable creator of "Everybody Loves Raymond," as he embarks on a global culinary adventure in "Somebody Feed Phil." With his infectious enthusiasm and boundless curiosity, Phil explores the world's most vibrant cities, sampling mouthwatering dishes and sharing heartwarming moments with locals. From bustling street markets to gourmet restaurants, each episode is a delightful feast for the senses. Get ready to laugh, learn, and eat your way around the world with Phil as your charming guide. Bon appétit!
</p>
  <div style="text-align:center">
  <button class="del-btn">Play Trailer!</button>
  <!-- <button onclick="playPause()">Play/Pause</button>
  <button onclick="makeBig()">Big</button>
  <button onclick="makeSmall()">Small</button>
  <button onclick="makeNormal()">Normal</button> -->
  <br><br>
  <!-- <video id="video1" width="420">
    <source src="/green-netflix/videos/mixkit-overhead-view-of-a-rocky-coast-and-waves-crashing-51502-hd-ready.mp4" type="video/mp4">

    Your browser does not support HTML video.
  </video> -->

  <iframe width="560" height="315" src="https://www.youtube.com/embed/Zv29Sjt7LnA?si=VclpwcrO03rRseBW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
  <BR><BR>
  <!--<p>Video courtesy of <a href="https://mixkit.co/" target="_blank">Mixkit</a>.</p>     -->
</div> 

  </div>
</div>

<?php } else{ ?>
    <h1>Login to play -- <?php echo $_GET['serieTitel']; ?></h1>
  <img src="./../../images/<?php echo $_GET['paddedId']; ?>.jpg" onerror="this.onerror=null;this.src='./../../images/error.png';">
  <BR><BR>
    <a target ="_new" href="<?php echo $_GET['imdbLink']; ?>"class='link-button'>IMDB Link</a>

<?php } ?>


<BR><BR>

<script> 
var myVideo = document.getElementById("video1"); 

function playPause() { 
  if (myVideo.paused) 
    myVideo.play(); 
  else 
    myVideo.pause(); 
} 

function makeBig() { 
    myVideo.width = 560; 
} 

function makeSmall() { 
    myVideo.width = 320; 
} 

function makeNormal() { 
    myVideo.width = 420; 
} 
</script> 





<!-- Main Content goes here - End -->

</main>
<?php include_once __DIR__ . '/../../include_sidebar.php'; ?>
</body>
</html>




