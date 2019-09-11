<?php
session_start();

include_once '../forms/timeout.php';

    if($_SESSION['login'] != 1){  // if not login
        
        
        header("Location: ../forms/login.php");
        exit();

    } else if($_SESSION['type']!=1 && $_SESSION['type']!=2){ // si pas admin ni modo

        header("Location: ../index.php");
        exit();

    }
    ?>

<!DOCTYPE html>

<!--
/var/www/webdip.barka.foi.hr/2018/zadaca_02/dgounot

chmod 775 . - open
chmod 770 . - close
-->

<html lang="en">

<head>

    <title>Moderator Section</title>
    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="registration">
    <meta name="keywords" content="form,infos,personnal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <script src="../javascript/dgounot.js" type="text/javascript"></script> 
    <script src="../javascript/dgounot_jquery.js" type="text/javascript"></script>  -->



</head>

<body>

    <header>
        <h1 id="page_title">Moderator Section</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 2){
        echo'<li><a href="../forms/logout.php">Logout</a></li>';    
        echo'<li><a href="./create-template.php">Create Template</a></li>';
        echo'<li><a href="./my-orders.php">My Orders</a></li>';    
        echo'<li><a href="./manage-vouchers.php">Edit Vouchers</a></li>';
            
        }
    ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 1){
        echo'<li><a href="../forms/logout.php">Logout</a></li>';    
        echo'<li><a href="./create-template.php">Create Template</a></li>';
        echo'<li><a href="./my-orders.php">My Orders</a></li>';    
        echo'<li><a href="./manage-vouchers.php">Edit Vouchers</a></li>';
            
        }
    ?>

    </menu>


    <div id="login">
        <div class="center"></div>

        <div class="field">

            <?php echo'Welcome '.$_SESSION['username'].' you are on the Moderation Section !' ?>


        </div>
        <div class="center"></div>

    </div>



    <footer>
        <div id="footer">

            <div class="logo_css3"> <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Fforms%2Fcategories.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=fr" target="_blank"><img src="../multimedia/image/CSS3.png" alt="CSS3 validation" width="100"></a></div>
            <div class="contact"> Contact me : <a href="mailto:gounot@et.esiea.fr"> contact</a>
                <br> Damien Gounot <br>27-02-2019<br> All Right Reserved</div>
            <div class="logo_html5"><a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Fforms%2Fcategories.php" target="_blank"><img src="../multimedia/image/HTML5.png" alt="HTML5 validation" width="100"></a></div>

        </div>
    </footer>
</body>

</html>
