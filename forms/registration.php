<?php
session_start();
include_once 'timeout.php';
include_once 'database-class.php';
$secretKey = '6Lfj4acUAAAAAFf2_pO1ybAmRDI0hFg1PNom0EHc';



if(isset($_POST['submit'])){
    
    $captcha = $_POST['g-recaptcha-response'];


    if(!$captcha){
        header("Location: registration.php");
                    exit();
        }
    
}


//ifmissingfields
if ((empty($_POST['username'])) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['repeat'])) {
} else {
    //ifnotmissingfield
    //ifcontainsillegalcharacters
    if (preg_match('/[\'#?!]/', $_POST['username']) || preg_match('/[\'#?!]/', $_POST['email']) || preg_match('/[\'#?!]/', $_POST['password']) || preg_match('/[\'#?!]/', $_POST['repeat'])) {
        echo'<script>alert("illegal characters !");</script>';
    } else {
        //fieldarenotemptyadnotillegal
        if ($_POST['password'] == $_POST['repeat']) {
            //silesdeuxpasswordsontidentiques
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                //siusernameok
                $db     = new MyDatabase();
                $c      = $db->connectToDB();
                $query  = "SELECT * FROM Users_Project WHERE username='" . $_POST['username'] . "'";
                $result = $db->selectDB($query);
                $user   = mysqli_fetch_assoc($result);
                $number = mysqli_num_rows($result);
                if ($number == 0) {
                    //siusernamepasutilisé
                    
                $query  = "SELECT * FROM Users_Project WHERE email='" . $_POST['email'] . "'";
                $result = $db->selectDB($query);
                $user   = mysqli_fetch_assoc($result);
                $number = mysqli_num_rows($result);
                if ($number == 0) {
                    
                    
                    //encrypt password

            $encPass = md5($_POST['password']);
            $hash = md5( rand(0,1000) );
                    
                    $time = date("Y-m-d;H:i:s");
                    
                    $insertQuery = "INSERT INTO `Users_Project` (`username`,`email`,`password`,`encrypted`,`type`,`status`,`points`,`spend_points`,`hash`,`time`) VALUES ('" . $_POST['username'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "','". $encPass ."','3','0','100','0','".$hash."','".$time."')";
                    mysqli_query($c, $insertQuery);
                    $db->closeDB();
                    $_SESSION['login'] = 0; //userlog
                    $_SESSION['type']  = 3; //normaluser
                    $_SESSION['username'] = $_POST['username'];
                    
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        //fwrite($fp, $date.";Query : ".$insertquery."\n");
        fclose($fp);
                    
                    
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_POST['username']." is a new user, welcomme !";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
                    
mail($_POST['email'], 'Signup | Verification', "Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: ".$_POST['username']."
Password: ".$_POST['password']."
Time: ".$time."
------------------------
 
Please click this link to activate your account: http://barka.foi.hr/WebDiP/2018_projekti/WebDiP2018x044/forms/verify.php?email=".$_POST['email']."&hash=".$hash."

It will be not available after 7 hours
", "From:noreply@dgounot.hr"); // Send our email
                    
                    
                    
                    header("Location: ../forms/logout.php");
                    exit();
                    
                    
                }else{
                    echo'<script>alert("the email is already used !");</script>';
                }
                    
                                
                } else {
                    echo'<script>alert("the username is already used !");</script>';
                }
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

    <title>Registration</title>
    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="registration">
    <meta name="keywords" content="form,infos,personnal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <script src='https://www.google.com/recaptcha/api.js'></script>

    <script src="../javascript/registration.js" type="text/javascript"></script>


</head>

<body>

    <header>
        <h1 id="page_title">Registration</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>

        <?php
        
        if(!isset($_SESSION['login'])){
         
            echo'<li><a href="./login.php">Login</a></li>';
        }else{
        
        
        if($_SESSION['login'] != 1){
         
            echo'<li><a href="./login.php">Login</a></li>';
        }else{
            

            echo'<li><a href="./logout.php">Logout</a></li>';
        }
        }
        ?>

        <li><a href="../other/categories.php">Categories</a></li>
    </menu>


    <div id="registration">

        <div class="center"></div>

        <form action="registration.php" method="POST" class="field">


            <!--
            <label>Select a Name using AJAX : <input id="name_input" list="name" name="name"></label>
            <datalist id="name"></datalist><br>
            <label>Select a surName using AJAX : <input id="surname_input" list="surname" name="surname"></label>
            <datalist id="surname"></datalist><br>

            <label>Select a state from JSON with auto UI : <input id="state_input" list="state" name="state"></label>
            <datalist id="state"></datalist><br>
-->
            <label> Username :
                <input type="text" name="username" id="username" onkeyup="checkRegistration();" required>
                <br>
            </label>

            <label> E-mail :
                <input name="email" id="email" onkeyup="checkRegistration();" required>
                <br>
            </label>
            <label> Password :
                <input type="password" name="password" id="password" onkeyup="checkRegistration();" required>
                <br>
            </label>
            <label> Comfirm :
                <input type="password" name="repeat" id="repeat" onkeyup="checkRegistration();" required>
                <br>
            </label>

                <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6Lfj4acUAAAAAEBvyeM1TBFCFajIeK60rvBYxbM9"></div><br>
                
            <label>
                <input type="submit" name="submit" value="Submit" id="submit_registration" onclick="return checkRegistration();">
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
