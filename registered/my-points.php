<?php
session_start();
include_once '../forms/timeout.php';
include_once '../forms/database-class.php';


    if($_SESSION['login'] != 1){  // if not login
        
        
        header("Location: ../forms/login.php");
        exit();

    } else if($_SESSION['type']!=1 && $_SESSION['type']!=2 && $_SESSION['type']!=3    ){ // si pas admin ni modo ni user

        header("Location: ../index.php");
        exit();

    }



$query = "SELECT points FROM Users_Project WHERE username='".$_SESSION['username']."'";
$db = new MyDatabase();
$c  = $db->connectToDB();
    $result   = $db->selectDB($query);
    $point     = mysqli_fetch_array($result);
    $db->closeDB();

    ?>

<!DOCTYPE html>

<!--
/var/www/webdip.barka.foi.hr/2018/zadaca_02/dgounot

chmod 775 . - open
chmod 770 . - close
-->

<html lang="en">

<head>

    <title>My Points</title>
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
        <h1 id="page_title">My Points</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 3 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="./make-purchase.php">Purchase</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./available-vouchers.php">Vouchers</a></li>';
            
        }
        
        ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 2 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';
            echo'<li><a href="./make-purchase.php">Purchase</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./available-vouchers.php">Vouchers</a></li>';
           
        }
        
        ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 1 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="../admin/admin-section.php">Administration</a></li>';            
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';
            echo'<li><a href="./make-purchase.php">Purchase</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./available-vouchers.php">Vouchers</a></li>';
           
        }
        
        ?>
    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">

                    <?php echo " My total number of points is : ".$point[0].""; ?>

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
