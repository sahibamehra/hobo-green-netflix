
    <!-- Nav Logic goes here - Start -->
    <nav class="navigation">
        <ul>
            <li><a href="/green-netflix">🏠</a></li>


    <?php 
    if(isset($_SESSION['user'])){
        //valid User
        $KlantNrVal=0;
        if(isset($_SESSION['KlantNr'])){
            $KlantNrVal=$_SESSION['KlantNr'];
        }

    ?>
            <li><a href="/green-netflix/views/profile?KlantNr=<?php echo $KlantNrVal; ?>">👤</a></li>
            <li><a href="/green-netflix/views/history?KlantNr=<?php echo $KlantNrVal; ?>">📜</a></li>
    <?php     
    }
    ?>

    <?php 
        if(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'Admin'){
            //valid Admin User
        ?>
            <li><a href="/green-netflix/views/profile/viewProfileList.php" style="color: #92d051;">👤</a></li>
        <?php     
        }
        ?>            

            
            <li><a href="/green-netflix/views/serie">📺</a></li>

            
            <li class="admin-text"><a href="/green-netflix/admin" >A</a></li>            
        </ul>
    </nav>

    

    <!-- Nav Logic goes here - End -->

