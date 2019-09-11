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
if(isset($_POST['name'])){
if(empty($_POST['name'])){
    echo'<script>alert("You must give a name");</script>';
$verif_name = false;
}else{
    
                    $name = preg_replace('/\s/', '', $_POST['name']);

    
    $verif_name = true;

}

}
?>




<?php
if(isset($_POST['categories'])){
if(empty($_POST['categories'])){
    echo'<script>alert("You must fill the categorie");</script>';
$verif_categorie = false;
}else{
    
    $verif_categorie = true;

}

}
?>


<?php

   if(isset($_FILES['voucherimage'])){
      $file_name = $_FILES['voucherimage']['name'];
      $file_size = $_FILES['voucherimage']['size'];
      $file_tmp = $_FILES['voucherimage']['tmp_name'];
      $file_type = $_FILES['voucherimage']['type'];
       
       $name_parts = explode('.',$_FILES['voucherimage']['name']);
       $file_ext = strtolower(end($name_parts));      
   
      if (preg_match('/[^A-Za-z0-9.]/', $file_name)){
          echo'<script>alert("illegal character in the filename !");</script>';
          $verif_file = false;

      }else{

    
          if($file_ext == "png" || $file_ext == "jpg"){
              
              if($file_size > 5000000){
                  echo'<script>alert("picture should be < 5Mb !");</script>';
                  $verif_file = false;

              }else{
              
                  
              $verif_file = true;
                  

              }
    }else{
              if(empty($_FILES['voucherimage']['name'])){
                                $verif_file = false;
                              echo'<script>alert("file is empty");</script>';

              }else{
echo'<script>alert("bad file extension, only jpg and png are allowed !");</script>';
                                $verif_file = false;
          }
          }
      }
   }

?>




<?php
if(isset($_POST['submit'])){
    
    if($verif_file && $verif_name  && $verif_categorie){
            include_once '../forms/database-class.php';
           $db     = new MyDatabase();
        $c      = $db->connectToDB();
        $query = "SELECT * FROM `Vouchers_Project` WHERE code='".$name."'";
    $result   = $db->selectDB($query);
    $number   = mysqli_num_rows($result);
    $db->closeDB();
        
        if($number != 0){
            
            echo '<script>alert("This name is already used !");</script>';
            
        }else{
        
        
        
            
        move_uploaded_file($file_tmp,"../multimedia/vouchers/".$file_name);

        $db     = new MyDatabase();
        $c      = $db->connectToDB();
        
        $insertQuery = "INSERT INTO `Vouchers_Project`(`code`, `description`, `categorie`, `active`, `image_path`) VALUES ('".$name."','".$_POST['limitedtextarea']."','".$_POST['categories'][0]."','0','../multimedia/vouchers/".$_FILES['voucherimage']['name']."')";
 
        mysqli_query($c, $insertQuery);
        
        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        //fwrite($fp, $date.";Query : ".$insertquery."\n");
        fclose($fp); 
        
        $db->closeDB();
    echo'<script>alert("Inserted successfully !")</script>';

        $text="".$_SESSION['username']." has created a voucher ".$name." in the categorie ".$_POST['categories'][0]."";
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

    <title>Create Voucher</title>
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

-->

</head>

<body>

    <header>
        <h1 id="page_title">Create Voucher</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./admin-section.php">Administration</a></li>
    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">


            <form action="create-voucher.php" method="POST" name="formulaire" enctype="multipart/form-data">



                <div class="data">

                    <label>Name: <input id="numb" name="name" required></label> <br>


                </div>



                <div class="data">
                    <div><label>Description:</label> <textarea id="textarea" name="limitedtextarea" rows="3" cols="40" onclick="textArea();" onKeyPress="limitText(this.form.limitedtextarea,this.form.countdown);" onblur="limitText(this.form.limitedtextarea,this.form.countdown);" required></textarea><br>



                    </div>

                </div>

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
                </div>


                <div class="data">

                    <label>Image :<input type="file" name="voucherimage" required></label><br>


                </div>

                <div class="data">
                    <input type="submit" name="submit" value="Submit" id="submit">
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
