<?php
session_start();

include_once './forms/timeout.php';

?>

<!DOCTYPE html>
<!--
/var/www/webdip.barka.foi.hr/2018/zadaca_02/dgounot

chmod 775 . - open
chmod 770 . - close
-->








<html lang="en">

<head>
    <title>Index</title>

    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="index">
    <meta name="keywords" content="sumary,picture,articles">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="./css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="./css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="./css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">

</head>

<body>

    <header>
        <h1 id="page_title">Index</h1>
        <img src="multimedia/image/foi-logo.jpg" alt="FOI Logo" class="logo_foi">
    </header>

    <menu>

        <?php
        if(!isset($_SESSION['login'])){
            echo'<li><a href="./forms/login.php">Login</a></li>';
            echo'<li><a href="./forms/registration.php">Registration</a></li>';
            echo'<li><a href="./other/categories.php">Categories</a></li>';
            echo'<li><a href="./documentation/about_author.html">About author</a></li>';
            echo'<li><a href="./documentation/documentation.html">Documentation</a></li>';


        }
        ?>

        <?php 
        
        if(isset($_SESSION['type']) && $_SESSION['type'] == 1){
        
        echo'<li><a href="./forms/logout.php">Logout</a></li>';
        echo'<li><a href="./other/categories.php">Categories</a></li>';
        echo'<li><a href="./documentation/about_author.html">About author</a></li>';
        echo'<li><a href="./documentation/documentation.html">Documentation</a></li>';
            
        echo'<li><a href="./admin/admin-section.php">Administration</a></li>'; // Acess Admin Section   
    
            
        echo'<li><a href="./moderator/moderator-section.php">Moderation</a></li>'; // Acess Moderation Section   
            
        echo'<li><a href="./registered/make-purchase.php">Purchase</a></li>'; // purchase a poster template    
        echo'<li><a href="./registered/my-purchases.php">History</a></li>'; // list of previous purchases
        echo'<li><a href="./registered/my-points.php">Points</a></li>'; // Display user Total Points
        echo'<li><a href="./registered/available-vouchers.php">Vouchers</a></li>'; // Display available vouchers
            
        }
        if(isset($_SESSION['type']) && $_SESSION['type'] == 2){
        
        echo'<li><a href="./forms/logout.php">Logout</a></li>';    
        echo'<li><a href="./other/categories.php">Categories</a></li>';
        echo'<li><a href="./documentation/about_author.html">About author</a></li>';
        echo'<li><a href="./documentation/documentation.html">Documentation</a></li>';
            
        echo'<li><a href="./moderator/moderator-section.php">Moderation</a></li>'; // Acess Moderation Section   

        
        echo'<li><a href="./registered/make-purchase.php">Purchase</a></li>'; // purchase a poster template    
        echo'<li><a href="./registered/my-purchases.php">History</a></li>'; // list of previous purchases
        echo'<li><a href="./registered/my-points.php">Points</a></li>'; // Display user Total Points
        echo'<li><a href="./registered/available-vouchers.php">Vouchers</a></li>'; // Display available vouchers
        
        }
        if(isset($_SESSION['type']) && $_SESSION['type'] == 3){
            
        echo'<li><a href="./forms/logout.php">Logout</a></li>';    
        echo'<li><a href="./other/categories.php">Categories</a></li>';
        echo'<li><a href="./documentation/about_author.html">About author</a></li>';
        echo'<li><a href="./documentation/documentation.html">Documentation</a></li>';
            
        echo'<li><a href="./registered/make-purchase.php">Purchase</a></li>'; // purchase a poster template    
        echo'<li><a href="./registered/my-purchases.php">History</a></li>'; // list of previous purchases
        echo'<li><a href="./registered/my-points.php">Points</a></li>'; // Display user Total Points
        echo'<li><a href="./registered/available-vouchers.php">Vouchers</a></li>'; // Display available vouchers
        }
        
        
            ?>

    </menu>


    <div id="infos_perso" style="height: 250px;">

        <div><img src="./multimedia/image/logo.png" alt="Me" class="BG" style="margin-left: 10%"></div>

        <div style="margin-top: 50px;">
            <p>Welcome on Business Poster Website !</p>
            <p>Here you we be able to share your poster &amp; to order business templates</p>
            <p>So do not hesitate and join us by registering an account !</p>
        </div>






    </div>


    <div id="articles_1_a_3">
        <div class="article1">


            <a href="./multimedia/image/premium.png" target="_blank"><img src="./multimedia/image/premium.png" alt="Premium" width="200" height="200" class="SW1"></a>

        </div>

        <div class="article2">



            <a href="./multimedia/image/world.png" target="_blank"><img src="./multimedia/image/world.png" alt="WorldWide" width="200" height="200" class="SW2"></a>

        </div>

        <div class="article3">



            <a href="./multimedia/image/invest.png" target="_blank"><img src="./multimedia/image/invest.png" alt="Invest" width="200" height="200" class="SW3"></a>

        </div>

    </div>

    <footer>
        <div id="footer">

            <div class="logo_css3"> <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Findex.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=fr" target="_blank"><img src="./multimedia/image/CSS3.png" alt="CSS3 validation" width="100"></a></div>
            <div class="contact"> Contact me : <a href="mailto:gounot@et.esiea.fr"> contact</a>
                <br> Damien Gounot <br>27-02-2019<br> All Right Reserved</div>
            <div class="logo_html5"><a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Findex.php" target="_blank"><img src="./multimedia/image/HTML5.png" alt="HTML5 validation" width="100"></a></div>

        </div>
    </footer>
</body>

</html>
