<?php
session_start();

include_once '../forms/timeout.php';
include_once '../forms/database-class.php';

    if($_SESSION['login'] != 1){  // if not login
        
                //echo'<script> alert("You must be logged to access this page !"); </script>';

        header("Location: ../forms/login.php");
                exit();

    } else if($_SESSION['type']!=1 && $_SESSION['type']!=2    ){ // si pas admin ni modo

                //echo'<script> alert("You do not have permission to access this page !")</script>';

        header("Location: ../index.php");
                exit();

    
    }
    ?>

<?php   if(isset($_POST['submit'])){
    

    
       
            
   if(isset($_FILES['template'])){
      $file_name = $_FILES['template']['name'];
      $file_size = $_FILES['template']['size'];
      $file_tmp = $_FILES['template']['tmp_name'];
      $file_type = $_FILES['template']['type'];
       
       $name_parts = explode('.',$_FILES['template']['name']);
       $file_ext = strtolower(end($name_parts));      
   
      if (preg_match('/[^A-Za-z0-9.]/', $file_name)){
          echo'<script>alert("illegal character in the filename !");</script>';
          $verif_file = false;

      }else{

    
          if($file_ext == "png"){
              
              if($file_size > 5000000){
                  echo'<script>alert("picture should be < 5Mb !");</script>';
                  $verif_file = false;

              }else{
              
                  
              $verif_file = true;
                  

              }
    }else{
              if(empty($_FILES['template']['name'])){
                                $verif_file = false;
                              echo'<script>alert("file is empty");</script>';

              }else{
echo'<script>alert("bad file extension, only png are allowed !");</script>';
                                $verif_file = false;
          }
          }
      }
   }
       
if(empty($_POST['price'])){
        echo'<script>alert("price is required !");</script>';
    $verif_price = false;

}else{

          
          
if(is_numeric($_POST['price'])){
    $verif_price = true;
    
}else{
    echo'<script>alert("price should be numeric value!");</script>';

    $verif_price = false;
}

}

    

   
   

            
            
            
    if(empty($_POST['name'])){
        $verif_name = false;
            echo'<script>alert("You must select a name!");</script>';

    }else{
        
                $name = preg_replace('/\s/', '', $_POST['name']);

    $db = new MyDatabase();
    $c  = $db->connectToDB();  
    $query    = "SELECT * FROM Templates_Project WHERE name='" . $name . "'";
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_assoc($result);
    $number   = mysqli_num_rows($result);
    $db->closeDB();
        
        
        if($number == 0){
            $verif_name = true;
        }else{
             $verif_name = false;
        
            echo'<script>alert("This template Name is already taken !");</script>';

        }
        
        
       
    }
            
            
            
         if(empty($_POST['limitedtextarea'])){
        $verif_description = false;
            echo'<script>alert("You must enter a description!");</script>';

    }else{
        $verif_description = true;
    }
    
    $categories =0;
                if(isset($_POST["categories"])){
			foreach ($_POST['categories'] as $subject) {
                $categories ++;

            }
            }

            if($categories == 0){
                echo'<script>alert("You must select a categorie !");</script>';
                $verif_categories= false;

            }else{
                    $verif_categories = true;

                    
                }
    
    
    if($verif_description && $verif_name && $verif_price && $verif_file && $verif_categories){
        $db     = new MyDatabase();
        $c      = $db->connectToDB();
        
        $query = "SELECT * FROM `Moderators_Permissions` WHERE moderator='".$_SESSION['username']."' AND categorie='".$_POST["categories"][0]."'";
        $result   = $db->selectDB($query);
    $user     = mysqli_fetch_assoc($result);
    $number   = mysqli_num_rows($result);        
    $db->closeDB();
        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
//fwrite($fp, $date.";Query : ".$query."\n");
        fclose($fp);
        

        
        if($number == 0 && $_SESSION['type'] != 1){
            
                   echo'<script>alert("You are not assigned to this categorie !");</script>';
         
        }else{
            
                            echo'<script>alert("Upload Success");</script>';

            move_uploaded_file($file_tmp,"../multimedia/templates/".$file_name);
            
            
            $name = preg_replace('/\s/', '', $_POST['name']);


    $insertQuery = "INSERT INTO `Templates_Project`(`name`, `description`, `price`, `template_path`, `categorie`, `creator`) VALUES ('".$name."','".$_POST['limitedtextarea']."','".$_POST['price']."','"."../multimedia/templates/".$file_name."','".$_POST['categories'][0]."','".$_SESSION['username']."')";
        $db     = new MyDatabase();
        $c      = $db->connectToDB();
            mysqli_query($c, $insertQuery);
              $db->closeDB();
            
        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
       // fwrite($fp, $date.";".$insertQuery."\n");
        fclose($fp);    
            
            
        $text ="The user ".$_SESSION['username']." upload a new template !";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
  
            
            
            
            
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

    <title>Create Template</title>
    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="registration">
    <meta name="keywords" content="form,infos,personnal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

   <script src="../javascript/create_template.js"></script>



</head>

<body>

    <header>
        <h1 id="page_title">Create Template</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./moderator-section.php">Moderation</a></li>

    </menu>




    <div id="login">

        <div class="center"></div>

        <div class="field">


            <form action="create-template.php" method="POST" name="formulaire" enctype="multipart/form-data">



                <div class="data">

                    <label>Name: <input id="name" name="name" onkeyup="checkCreation();" required></label> <br>
                    <label>Price: <input min="0" type="number" id="price" name="price" onkeyup="checkCreation();" required></label> <br>

                    <label>Description:</label> <textarea id="description" name="limitedtextarea" rows="3" cols="40" onclick="textArea();" onKeyPress="limitText(this.form.limitedtextarea,this.form.countdown);" onblur="limitText(this.form.limitedtextarea,this.form.countdown);" onkeyup="checkCreation();" required></textarea><br>


                    <label>Select a categorie : <select id="categorie" name="categories[]" onchange="selection()" onkeyup="checkCreation();" required>

                            <?php
                        
                        
                                      
                        $db = new MyDatabase();
                        $c  = $db->connectToDB();
                        
                        if($_SESSION['type']== 1){
                            
                    $query    = "SELECT * FROM `Categories_Project` ORDER BY name";
                        $select   = $db->selectDB($query);        
                        while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="categories" value='.$result[0].'>'.$result[0].'</option>';
    }        
                            
                        }else{
                            
                                $query    = "SELECT * FROM Moderators_Permissions WHERE moderator='".$_SESSION['username']."'";
                        //echo $query;
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="categories" value='.$result[0].'>'.$result[0].'</option>';
    }
                            
                            
                        }
                        

    $db->closeDB();
                            ?>



                        </select></label><br>

                    <label>Image :<input type="file" name="template" required></label><br>

                    <input type="submit" name="submit" value="Submit" id="submit" onclick="return checkCreation();">
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
