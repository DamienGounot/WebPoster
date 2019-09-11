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

<?php

if(isset($_POST['edit'])){
    
    if(isset($_POST['vouchers'])){
    
    if(empty($_POST['vouchers']) || !is_numeric($_POST['points'])){
        
        echo'<script>alert("error");</script>';
    }else{
        
        $query = "UPDATE `Vouchers_Project` SET points_needed = '".$_POST['points']."' , expiration = '".$_POST['expiration']."'  WHERE code = '".$_POST['vouchers'][0]."'";
        $db     = new MyDatabase();
        $c      = $db->connectToDB();
        
        mysqli_query($c, $query);
        
        $text = "".$_SESSION['username']." change the points needed of the Voucher ".$_POST['vouchers'][0]." to ".$_POST['points']." and the expiration to ".$_POST['expiration']."";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp); 
        
        $db->closeDB();
        
    }
    
}
    
    
    
}

?>


<?php 

if(isset($_POST['activate'])){
    
    $query = "UPDATE `Vouchers_Project` SET active =1 WHERE code = '".$_POST['voucherstochange'][0]."'";
        $db     = new MyDatabase();
        $c      = $db->connectToDB();
        
        mysqli_query($c, $query);
        
        $text = "".$_SESSION['username']." change the status of the Voucher ".$_POST['voucherstochange'][0]." to activate";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp); 
        
        $db->closeDB();
}
?>

<?php 

if(isset($_POST['desactivate'])){
        
        $query = "UPDATE `Vouchers_Project` SET active =0 , points_needed =NULL, expiration=NULL WHERE code = '".$_POST['voucherstochange'][0]."'";
        $db     = new MyDatabase();
        $c      = $db->connectToDB();
        

        mysqli_query($c, $query);
        
        $text = "".$_SESSION['username']." change the status of the Voucher ".$_POST['voucherstochange'][0]." to desactivate";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp); 
        
        $db->closeDB();
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

    <title>Manage Vouchers</title>
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
        <h1 id="page_title">Manage Vouchers</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./moderator-section.php">Moderation</a></li>

    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">

                                <form action="manage-vouchers.php" method="POST" name="formulaire" enctype="multipart/form-data">



                <div class="data">
                                    <br><div class="title">Edit vouchers properties : </div><br>


                    <label>Available Voucher : <select id="dropdown" name="vouchers[]" onchange="selection()" required>

                              <?php
                        
                        
                                      
                        $db = new MyDatabase();
                        $c  = $db->connectToDB();
                        
                        if($_SESSION['type']== 1){
                            
                    $query    = "SELECT * FROM `Vouchers_Project` WHERE active='1' ORDER BY code";
                        $select   = $db->selectDB($query);        
                        while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="vouchers" value='.$result[0].'>'.$result[0].'</option>';
    }        
                            
                        }else{
                            
                                $query    = "SELECT * FROM Moderators_Permissions WHERE moderator='".$_SESSION['username']."'";
                        //echo $query;
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
         $query2    = "SELECT * FROM `Vouchers_Project` WHERE categorie='".$result[0]."' AND active='1' ORDER BY code";
            $select2   = $db->selectDB($query2);
            while($result2 = mysqli_fetch_array($select2)){
                
                        echo '<option name="vouchers" value='.$result2[0].'>'.$result2[0].'</option>';

                
            }
    }
                            
                            
                        }
                        

    $db->closeDB();
                            ?>



                        </select></label><br>                    <label>Required Points: <input min="0" type="number" id="points" name="points" required></label> <br>
                    <label>Expiration: <input type="date" id="expiration" name="expiration" required></label> <br>

                </div>




                <div class="data">


                </div>

                <div class="data">
                    <input type="submit" name="edit" value="Edit" >
                </div>

            </form>

        </div>
        <div class="center"></div>
        
        
        
        <div class="center"></div>

        <div class="field">

                                <form action="manage-vouchers.php" method="POST" name="activate" enctype="multipart/form-data">



                <div class="data">
                <br><div class="title">In my assigned categories :</div><br>

                    <label>Select a Voucher : <select  name="voucherstochange[]" onchange="selection()" required>

                              <?php
                        
                        
                                      
                        $db = new MyDatabase();
                        $c  = $db->connectToDB();
                        
                        if($_SESSION['type']== 1){
                            
                    $query    = "SELECT * FROM `Vouchers_Project` ORDER BY code";
                        $select   = $db->selectDB($query);        
                        while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="voucherstochange" value='.$result[0].'>'.$result[0].'</option>';
    }        
                            
                        }else{
                            
                                $query    = "SELECT * FROM Moderators_Permissions WHERE moderator='".$_SESSION['username']."'";
                        //echo $query;
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
         $query2    = "SELECT * FROM `Vouchers_Project` WHERE categorie='".$result[0]."' ORDER BY code";
            $select2   = $db->selectDB($query2);
            while($result2 = mysqli_fetch_array($select2)){
                
                        echo '<option name="vouchers" value='.$result2[0].'>'.$result2[0].'</option>';

                
            }
    }
                            
                            
                        }
                        

    $db->closeDB();
                            ?>



                        </select></label><br>                    
                </div>




                <div class="data">


                </div>

                <div class="data">
                    <input type="submit" name="activate" value="Activate" id="activate">
                    <input type="submit" name="desactivate" value="Desactivate" id="desactivate">

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
