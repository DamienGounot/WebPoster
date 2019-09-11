<?php
session_start();
include_once '../forms/timeout.php';
include_once '../forms/database-class.php';

    //echo 'start';

if(isset($_POST['email'])){
    
        //echo 'isset';
if (empty($_POST['email'])){
   // echo 'empty';
} else {
//    echo 'bad email';

            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                $db     = new MyDatabase();
                $c      = $db->connectToDB();
                $query  = "SELECT * FROM Users_Project WHERE email='" . $_POST['email'] . "'";
                $result = $db->selectDB($query);
                $user   = mysqli_fetch_array($result);
                $number = mysqli_num_rows($result);
                
            //        echo $query;

                if ($number == 0) {
                    
                    echo '<script>alert("this email is not used");</script>';
                    
                 //   echo 'no result';
                    
                    
                }else{

                    
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "Password has been send to ".$_POST['email']." !";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
                    
                    
mail($_POST['email'], 'Forgotten password', "Hello, it seems that the password related to your email adress has been forgotten.

This is all the informations you will need to retrieve your access :
 
------------------------
Username: ".$user[0]."
E-Mail: ".$user[1]."
Password: ".$user[2]."
------------------------
", "From:noreply@dgounot.hr"); // Send our email
                    
                    
                   session_destroy();
 
                    header("Location: ../forms/logout.php");
                    exit();
                    
                    
                }
                    
                                
                }
            }
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

    <title>Forget Password</title>
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
-->
    <!--
     <script src="../javascript/dgounot.js" type="text/javascript"></script> 
    <script src="../javascript/dgounot_jquery.js" type="text/javascript"></script> 
-->

    <script src="../javascript/registration.js" type="text/javascript"></script>


</head>

<body>

    <header>
        <h1 id="page_title">Forget Password</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>


        <li><a href="../other/categories.php">Categories</a></li>
    </menu>


    <div id="registration">

        <div class="center"></div>

        <form action="forget-password.php" method="POST" class="field">


            <!--
            <label>Select a Name using AJAX : <input id="name_input" list="name" name="name"></label>
            <datalist id="name"></datalist><br>
            <label>Select a surName using AJAX : <input id="surname_input" list="surname" name="surname"></label>
            <datalist id="surname"></datalist><br>

            <label>Select a state from JSON with auto UI : <input id="state_input" list="state" name="state"></label>
            <datalist id="state"></datalist><br>
-->
            <br><label> E-mail :
                <input name="email" id="email" onkeyup="checkRegistration();" required>
                <br>
            </label>



            <label>
                <input type="submit" name="submit" value="Send password" id="submit_registration" onclick="return checkRegistration();">
            </label>

        </form>
        <div class="center"></div>

    </div>




    <footer>
        <div id="footer">

            <div class="logo_css3"> <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Fforms%2Fregistration.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=fr" target="_blank"><img src="../multimedia/image/CSS3.png" alt="CSS3 validation" width="100"></a></div>
            <div class="contact"> Contact me : <a href="mailto:gounot@et.esiea.fr"> contact</a>
                <br> Damien Gounot <br>27-02-2019<br> All Right Reserved</div>
            <div class="logo_html5"><a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Fforms%2Fregistration.php" target="_blank"><img src="../multimedia/image/HTML5.png" alt="HTML5 validation" width="100"></a></div>

        </div>
    </footer>
</body>

</html>
