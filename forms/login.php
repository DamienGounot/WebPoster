<?php
session_start();

include_once 'timeout.php';
include_once 'database-class.php';

$db = new MyDatabase();
$c  = $db->connectToDB();
if (isset($_POST['user'])) {
    $username = $_POST['user'];
    $password = $_POST['password'];
    
    $encrypted = md5($_POST['password']);
    
    $query    = "SELECT * FROM Users_Project WHERE username='" . $username . "' AND encrypted='" . $encrypted . "'"; // on essaye de se connecter
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_assoc($result);
    $number   = mysqli_num_rows($result);
    $db->closeDB();
    
    if ($number == 0) { // combinaison user/mdp fausse
        echo '<script> alert("unsuccessful login : try again !");</script>';

$db = new MyDatabase();
$c  = $db->connectToDB();  
    $query    = "SELECT * FROM Users_Project WHERE username='" . $username . "'"; // on verifie que le user existe cad que le mdp uniquement est faux
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_assoc($result);
    $number   = mysqli_num_rows($result);
        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
//fwrite($fp, $date.";Query : ".$query."\n");
        fclose($fp);
        $db->closeDB();
        
        if ($number == 0) {
            // si l'utilisateur etaitf faux , on ne fait rien
        }else{
            
$db = new MyDatabase();
$c  = $db->connectToDB();
            $query    = "SELECT * FROM Users_Project WHERE username='" . $username . "'";
                $result   = $db->selectDB($query);
    $user     = mysqli_fetch_array($result);
            
            $error = $user[9];   // on récupère son nombre de fausse tentatives
            $error ++; // on l'incrémente

            $query = "UPDATE Users_Project SET error = '".$error."' WHERE username='".$username."'"; // on update
            
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
//fwrite($fp, $date.";Query : ".$query."\n");
        fclose($fp);
            
            $result   = $db->selectDB($query);

        $text ="unsuccessful login for ".$username." number of error : ".$error."";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
        $db->closeDB();

        }
        
        

        
        
        
        
    } else { // si bonne combinaison
        
        
        $db = new MyDatabase();
        $c  = $db->connectToDB();  
    $query    = "SELECT * FROM Users_Project WHERE username='" . $username . "'";
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_array($result);
    $number   = mysqli_num_rows($result);
    $error = $user[9]; // on récupère son nombre d'erreur
    $db->closeDB();
        
        
        
        
        if($error >= 3){ // si trop d'erreur
            
        $user['status'] == 0; // on bloque le user
            
    $db = new MyDatabase();
    $c = $db->connectToDB();

    $query = "UPDATE Users_Project SET status = '0' WHERE username='".$username."'"; // on update le status du user
            
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
     //   fwrite($fp, $date.";".$query."\n");
        fclose($fp);
            
    $result = $db->selectDB($query);
    $db->closeDB();
            
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$username.""." has been blocked";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
            
            
        }else{ // si pas encore bloqué
            
                $db = new MyDatabase();
            $c  = $db->connectToDB();        
            
    $query = "UPDATE Users_Project SET error = '0' WHERE username='".$username."'"; // on reset le nb d'erreurs
    $result   = $db->selectDB($query);
    $db->closeDB();
            
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        //fwrite($fp, $date.";".$query."\n");
        fclose($fp);        
            
            
        }
        
    $db = new MyDatabase();
    $c  = $db->connectToDB();  
    $query    = "SELECT * FROM Users_Project WHERE username='" . $username . "'";
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_array($result);
    $db->closeDB();
        
        if($user['status'] == 1){ // si le compte est actif
            
        $_SESSION['login'] = 1;
        $_SESSION['type']  = $user['type'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['status'] = $user['status'];  
        $_SESSION['points'] = $user['points'];
        $_SESSION['spend_points'] = $user['spend_points'];

        $text ="successful login for ".$username."";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
        
        
                if(isset($_POST['accept'])){
            
                    if(!empty($_POST['accept'])){
            
        $text="".$username." has accepted the Terms of Usage";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);            
        setcookie("ACCEPT",$_POST["accept"], time()+2592000); // one month cookie
        }else{
                        echo '<script> alert("You must accept the Terms of usage !");</script>';
                    }
        }
        
        
        header("Location: ../index.php");
        exit();
            
        }else{
            
            echo '<script> alert("This account is not activate !");</script>';

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
    <title>Login</title>

    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="login">
    <meta name="keywords" content="form,,user,password">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">

     <script src="../javascript/login.js"></script>

</head>

<body>

    <header>
        <h1 id="page_title">Login</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>


        <li><a href="./registration.php">Registration</a></li>
        <li><a href="../other/categories.php">Categories</a></li>

    </menu>


    <div id="login">
        <div class="center"></div>

        <div class="field">

            <form action="login.php" method="POST">


                <label>User : <input type="text" name="user" id="user"  required></label>
                <br>

                <label>Password :</label>
                <input type="password" name="password" id="password"  required>
                <br>

                <label>I Accept <a href="../other/tou.html" target="_blank">Terms of Usage</a></label>
                <input type="checkbox" name="accept" id="accept" value="accept"  required <?php
if(isset($_COOKIE["ACCEPT"])) {
    echo'checked';
}
?>>
                <br>
                <a href="../other/forget-password.php">forget password</a><br>

                <label></label>
                <input type="submit" name="submit" value="Submit" id="submit" onclick="verifUser();verifPass();">


            </form>

        </div>
        <div class="center"></div>

    </div>

    <footer>
        <div id="footer">

            <div class="logo_css3"> <a href="https://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Fforms%2Flogin.php&profile=css3svg&usermedium=all&warning=1&vextwarning=&lang=fr" target="_blank"><img src="../multimedia/image/CSS3.png" alt="CSS3 validation" width="100"></a></div>
            <div class="contact"> Contact me : <a href="mailto:gounot@et.esiea.fr"> contact</a>
                <br> Damien Gounot <br>27-02-2019<br> All Right Reserved</div>
            <div class="logo_html5"><a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fbarka.foi.hr%2FWebDiP%2F2018%2Fzadaca_04%2Fdgounot%2Fforms%2Flogin.php" target="_blank"><img src="../multimedia/image/HTML5.png" alt="HTML5 validation" width="100"></a></div>

        </div>
    </footer>
</body>

</html>
