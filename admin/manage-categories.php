<?php
session_start();

include_once '../forms/timeout.php';
include_once '../forms/database-class.php';

    if($_SESSION['login'] != 1){  // if not login
        
                //echo'<script> alert("You must be logged to access this page !"); </script>';

        header("Location: ../forms/login.php");
                exit();

    } else if($_SESSION['type']!=1){ // si pas admin 
                //echo'<script> alert("You do not have permission to access this page !")</script>';

        header("Location: ../index.php");
                exit();

    
    }
    ?>


<?php
$categories = 0;
$moderator = 0;

		if(isset($_POST["allow"])) 
		{
        
            if(isset($_POST["categories"])){
			foreach ($_POST['categories'] as $subject) {
                $categories ++;

            }
            }

            if($categories == 0){
                echo'<script>alert("You must select a categorie !");</script>';
                $verif_categorie= false;

            }else{
                    $verif_categorie = true;

                    
                }
            
            if(isset($_POST["moderator"])){
			foreach ($_POST['moderator'] as $subject) {
                $moderator ++;

            }
            }

            if($moderator == 0){
                echo'<script>alert("You must assign a Moderator !");</script>';
                $verif_moderator= false;

            }else{
                    $verif_moderator = true;

                    
                }
            
            
            if($verif_categorie && $verif_moderator){
                
                $db = new MyDatabase();
                $c  = $db->connectToDB();
                
            $query  = "SELECT * FROM Moderators_Permissions WHERE categorie='" . $_POST['categories'][0] . "' AND moderator='".$_POST['moderator'][0]."'";
                
                $result = $db->selectDB($query);
                $user   = mysqli_fetch_assoc($result);
                $number = mysqli_num_rows($result);
                
                if ($number == 0) {       
                
                
    $insertQuery    = "INSERT INTO `Moderators_Permissions`(`categorie`, `moderator`) VALUES ('".$_POST['categories'][0]."','".$_POST['moderator'][0]."')";
        mysqli_query($c, $insertQuery);
            echo'<script>alert("Successfully inserted !");</script>';
                  
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username']." has assigned the categorie ".$_POST['categories'][0]." to ".$_POST['moderator'][0]."";
        //fwrite($fp, $date.";Query : ".$insertquery."\n");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);    
         $db->closeDB();
               
                    
                }else{
                    echo'<script>alert("This moderator is already assigned to this categorie !");</script>';
                }

            }
            
            
            }
?>





<?php
$categories = 0;
$moderator = 0;

		if(isset($_POST["disallow"])) 
		{
        
            if(isset($_POST["categories"])){
			foreach ($_POST['categories'] as $subject) {
                $categories ++;

            }
            }

            if($categories == 0){
                echo'<script>alert("You must select a categorie !");</script>';
                $verif_categorie= false;

            }else{
                    $verif_categorie = true;

                    
                }
            
            if(isset($_POST["moderator"])){
			foreach ($_POST['moderator'] as $subject) {
                $moderator ++;

            }
            }

            if($moderator == 0){
                echo'<script>alert("You must assign a Moderator !");</script>';
                $verif_moderator= false;

            }else{
                    $verif_moderator = true;

                    
                }
            
            
            if($verif_categorie && $verif_moderator){
                
                $db = new MyDatabase();
                $c  = $db->connectToDB();
                
            $query  = "SELECT * FROM Moderators_Permissions WHERE categorie='" . $_POST['categories'][0] . "' AND moderator='".$_POST['moderator'][0]."'";
                
                $result = $db->selectDB($query);
                $user   = mysqli_fetch_assoc($result);
                $number = mysqli_num_rows($result);
                
                if ($number != 0) {       
                
                
    $deleteQuery    = "DELETE FROM `Moderators_Permissions` WHERE categorie='".$_POST['categories'][0]."' AND moderator='".$_POST['moderator'][0]."'";
        mysqli_query($c, $deleteQuery);
            echo'<script>alert("Successfully deleted !");</script>';
                  
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username']." has unAssign the categorie ".$_POST['categories'][0]." to ".$_POST['moderator'][0]."";
        //fwrite($fp, $date.";Query : ".$insertquery."\n");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);    
         $db->closeDB();
               
                    
                }else{
                    echo'<script>alert("This moderator is not assigned assigned to this categorie !");</script>';
                }

            }
            
            
            }
?>



<?php 

		if(isset($_POST["add"])) 
        {
            
            if(empty($_POST['addCat'])){
                
                echo'<script>alert("You must enter a categorie to add !");</script>';
            }else{
                
                $add = preg_replace('/\s/', '', $_POST['addCat']);

                
                $db = new MyDatabase();
                $c  = $db->connectToDB();
                $query = "SELECT * FROM `Categories_Project` WHERE name='".$add."'";
                $result   = $db->selectDB($query);                
                $user     = mysqli_fetch_assoc($result);
                $number   = mysqli_num_rows($result);
                $db->closeDB();
                
                
                if($number != 0){
                    
                    echo'<script>alert("This categorie already exist !");</script>';
                    
                }else{
                
                
                
                $db = new MyDatabase();
                $c  = $db->connectToDB();
                $insertQuery = "INSERT INTO `Categories_Project`(`name`) VALUES ('".$add."')";
                mysqli_query($c, $insertQuery);
                echo'<script>alert("The Categorie was added !");</script>';

                $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username']." has added the categorie ".$add."" ;
        //fwrite($fp, $date.";Query : ".$insertquery."\n");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
            $db->closeDB();
        
                
            }
            
        }
        }

?>


<?php 
$delete = 0;


		if(isset($_POST["delete"])) 
        {
                            
                $remove = preg_replace('/\s/', '', $_POST['categorietoremove'][0]);

                
			foreach ($_POST['categorietoremove'] as $subject) {
                $delete ++;

            }
            

            if($delete == 0){
                echo'<script>alert("You must select a categorie to remove !");</script>';

            }else{


                $db = new MyDatabase();
                $c  = $db->connectToDB();
                $DeleteQuery = "DELETE FROM `Categories_Project` WHERE name='".$remove."'";
                mysqli_query($c, $DeleteQuery);
                echo'<script>alert("The Categorie was deleted !");</script>';
            $permissionQuery = "DELETE FROM `Moderators_Permissions` WHERE categorie='".$remove."'";
        mysqli_query($c, $permissionQuery);


        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username']." has deleted the categorie ".$remove."" ;
        //fwrite($fp, $date.";Query : ".$DeleteQuery."\n");
        fwrite($fp, $date.";".$text."\n");
        
        $text = "".$_SESSION['username']."All moderators are now not assigned to ".$remove."" ;
        
        fclose($fp);
            $db->closeDB();                    
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

    <title>Manage Categories</title>
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
        <h1 id="page_title">Manage Categories</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./admin-section.php">Administration</a></li>
    </menu>




    <div id="login">
        <div class="center"></div>
        
        <div class="field">

            <form action="manage-categories.php" method="POST" name="addACategorie" enctype="multipart/form-data">



                <div class="data">


                    <label>Add a categorie: <input type="text" id="add" name="addCat" onchange="selection()" required></select></label>

<input type="submit" name="add" value="Add">
                </div>



                    

            </form>
        
                    <form action="manage-categories.php" method="POST" name="removeACategorie" enctype="multipart/form-data">



                <div class="data">


                     <label>Select a Categorie : <select id="dropdown" name="categorietoremove[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();
    $query    = "SELECT * FROM Categories_Project ORDER BY name";
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="categorietoremove" value='.$result[0].'>'.$result[0].'</option>';
        
    }
    $db->closeDB();
                            ?>



                        </select></label>

<input type="submit" name="delete" value="Delete">
                </div>



                    

            </form>
        </div>
        
        
        
        
        
        

        <div class="field">

            <form action="manage-categories.php" method="POST" name="formulaire" enctype="multipart/form-data">



                <div class="data">


                    <label>Select a categorie : <select id="dropdown" name="categories[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();
    $query    = "SELECT * FROM Categories_Project ORDER BY name";
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="categories" value='.$result[0].'>'.$result[0].'</option>';
    }
    $db->closeDB();
                            ?>



                        </select></label><br>

                    <label>Assign a Moderator : <select id="dropdown" name="moderator[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();
    $query    = "SELECT * FROM Users_Project WHERE type='2'";
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="moderator" value='.$result[0].'>'.$result[0].'</option>';
        
    }
    $db->closeDB();
                            ?>



                        </select></label><br>


                </div>



                <div class="data">
                    <input type="submit" name="allow" value="allow">
                    <input type="submit" name="disallow" value="disallow">
                </div>
                
 
            </form>
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
