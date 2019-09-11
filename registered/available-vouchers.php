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

    ?>




<?php

    if(isset($_POST['buy'])){
        
    $db = new MyDatabase();
    $c = $db->connectToDB();
        
        
                                $query_points = "SELECT points, spend_points FROM Users_Project WHERE username='".$_SESSION['username']."'";
                        $select_points = $db->selectDB($query_points);
                        $result_points = mysqli_fetch_array($select_points);
                    
                        $my_points = $result_points[0];
                        $my_spend_points = $result_points[1];
        
 
        
        $select_insert = "SELECT * FROM `Users_Vouchers` WHERE username='".$_SESSION['username']."' AND userVoucher = '".$_POST['vouchertobuy'][0]."' AND isUsed = 1";
        $insertVoucher = $db->selectDB($select_insert);
      $number   = mysqli_num_rows($insertVoucher);
        
        

        
        if($number == 0){
            
                    $select_insert2 = "INSERT INTO `Users_Vouchers`(`username`, `userVoucher`, `isUsed`) VALUES ('".$_SESSION['username']."','".$_POST['vouchertobuy'][0]."','1')";
                    $insertVoucher2 = $db->selectDB($select_insert2);
            
            $retrive_price = "SELECT points_needed FROM Vouchers_Project WHERE code ='".$_POST['vouchertobuy'][0]."'";
            $retrive = $db->selectDB($retrive_price);
            $result_price = mysqli_fetch_array($retrive);
            
            $maj_point = $my_points - $result_price[0];
            $maj_spend = $my_spend_points + $result_price[0];
            
            $update_points = "UPDATE `Users_Project` SET points='".$maj_point."', spend_points= '".$maj_spend."' WHERE username ='".$_SESSION['username']."'"; 
            $update = $db->selectDB($update_points);
                
            

            

        }else{
            echo '<script>alert("error voucher already used");</script>';
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

    <title>Available vouchers</title>
    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="registration">
    <meta name="keywords" content="form,infos,personnal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">

    
    
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js">
    </script>

    <script src="../javascript/available-vouchers.js"></script>



</head>

<body>

    <header>
        <h1 id="page_title">Available vouchers</h1>
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
            echo'<li><a href="./my-points.php">Points</a></li>';
            
        }
        
        ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 2 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';
            echo'<li><a href="./make-purchase.php">Purchase</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./my-points.php">Points</a></li>';
            
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
            echo'<li><a href="./my-points.php">Points</a></li>';
            
        }
        
        ?>




    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">

                <form action="available-vouchers.php" method="POST" name="formulaire" enctype="multipart/form-data">



        
                        <div id="responsive_table">

            <div style="text-align:center;">


            </div>


            <table id="table" class="display" data-page-length='7'>
                
                    <br><div class="title">Available Vouchers</div><br>

                <thead>

                    <tr>
                        <th style="text-align: center">Voucher</th>
                    </tr>

                </thead>
                <tbody>


                    <?php

    $db = new MyDatabase();
    $c = $db->connectToDB();
                    
                        
                        $query_points = "SELECT points, spend_points FROM Users_Project WHERE username='".$_SESSION['username']."'";
                        $select_points = $db->selectDB($query_points);
                        $result_points = mysqli_fetch_array($select_points);
                    
                        $my_points = $result_points[0];
                        $my_spend_points = $result_points[1];
                        $date = date("Y-m-d");       

                    
                    
                    
                    
                        $query_vouchers_available = "SELECT code, image_path, expiration FROM `Vouchers_Project` WHERE (points_needed < $my_points OR points_needed != NULL) AND active = 1 AND(expiration > '".$date."' OR expiration != NULL)";
                        $select_vouchers_available = $db->selectDB($query_vouchers_available);
                    
                            while($vouchers_available = mysqli_fetch_array($select_vouchers_available)){ 
                                
                               $query_used ="SELECT * FROM Users_Vouchers WHERE username='".$_SESSION['username']."' AND isUsed = 1 AND  userVoucher ='".$vouchers_available[0]."'";
                                $select_used = $db->selectDB($query_used);
                            //    echo $query_used;
                              //  $result_used = mysqli_fetch_array($select_used);   
                                $number_used   = mysqli_num_rows($select_used);
   
                                    
                                                                    echo'<tr>';
                                if($number_used == 1){
                                    
                        echo"<td style='text-align: center'>".$vouchers_available[0]."</td>";
                                    
                                }else{
                                echo"<td style='text-align: center' > <img src='".$vouchers_available[1]."' alt ='".$vouchers_available[0]."' width='200' height='100' ></td>";
                                }

                                echo'</tr>';
                                    
                                    
                                
                        }
$db->closeDB();
?>


                </tbody>
            </table>
        </div>
                    
                    <br><div class="title">Voucher's Infos</div><br>

                    
                    
                                         <label>Select a Voucher : <select name="selectedvoucher[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();

                                             
    $query_vouchers_available = "SELECT code FROM `Vouchers_Project` WHERE (points_needed < $my_points OR points_needed != NULL) AND active = 1 AND(expiration > '".$date."' OR expiration != NULL)";
                        $select_vouchers_available = $db->selectDB($query_vouchers_available);
                    
    while($vouchers_available = mysqli_fetch_array($select_vouchers_available)){ 
                                
$query_used ="SELECT * FROM Users_Vouchers WHERE username='".$_SESSION['username']."' AND isUsed = 1 AND  userVoucher ='".$vouchers_available[0]."'";
                $select_used = $db->selectDB($query_used);
                $number_used   = mysqli_num_rows($select_used);                                         
                                             
                              if($number_used == 0){
                                  
        echo '<option name="selectedvoucher" value='.$vouchers_available[0].'>'.$vouchers_available[0].'</option>';
                              }               
        
        
        
        
    }
    $db->closeDB();
                            ?>



                        </select></label>

                        <input type="submit" name="select" value="Select">
                    
                    
                    
            <div id="responsive_table">

            <div style="text-align:center;">


            </div>


            <table id="table" class="display" data-page-length='7'>
                

                <thead>

                    <tr>
                        <th style="text-align: center">Code</th>
                        <th style="text-align: center">Voucher</th>
                        <th style="text-align: center">Description</th>
                        <th style="text-align: center">Categorie</th>
                        <th style="text-align: center">Needed Points</th>
                        <th style="text-align: center">Expiration</th>
                    </tr>

                </thead>
                <tbody>


                    <?php

    $db = new MyDatabase();
    $c = $db->connectToDB();
                    
                    if(isset($_POST['select'])){
                        
                        $query_vouchers_infos = "SELECT * FROM `Vouchers_Project` WHERE (points_needed < $my_points OR points_needed != NULL) AND active = 1 AND(expiration > '".$date."' OR expiration != NULL) AND code='".$_POST['selectedvoucher'][0]."'";
                        $select_vouchers_infos = $db->selectDB($query_vouchers_infos);
                        
                        $vouchers_infos = mysqli_fetch_array($select_vouchers_infos);

                        echo'<tr>';
                        echo'<td>'.$vouchers_infos[0].'</td>';
                        echo'<td><img src="'.$vouchers_infos[6].'" alt=".$vouchers_infos[0]." width ="200px" height="100px"</td>';
                        echo'<td>'.$vouchers_infos[1].'</td>';
                        echo'<td>'.$vouchers_infos[2].'</td>';
                        echo'<td>'.$vouchers_infos[3].'</td>';
                        echo'<td>'.$vouchers_infos[4].'</td>';
                        echo'</tr>';
                                         
                    }
                    
$db->closeDB();
?>


                </tbody>
            </table>
        </div>   
                    
            </form>
            <form action="available-vouchers.php" method="POST" name="buy" enctype="multipart/form-data">
                    <br><div class="title">Buy Vouchers</div><br>
                    
                    
                    
            <label>Select a Voucher : <select name="vouchertobuy[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();

                                             
    $query_vouchers_available = "SELECT code FROM `Vouchers_Project` WHERE (points_needed < $my_points OR points_needed != NULL) AND active = 1 AND(expiration > '".$date."' OR expiration != NULL)";
                        $select_vouchers_available = $db->selectDB($query_vouchers_available);
                    
    while($vouchers_available = mysqli_fetch_array($select_vouchers_available)){ 
                                
$query_used ="SELECT * FROM Users_Vouchers WHERE username='".$_SESSION['username']."' AND isUsed = 1 AND  userVoucher ='".$vouchers_available[0]."'";
                $select_used = $db->selectDB($query_used);
                $number_used   = mysqli_num_rows($select_used);                                         
                                             
                              if($number_used == 0){
                                  
        echo '<option name="vouchertobuy" value='.$vouchers_available[0].'>'.$vouchers_available[0].'</option>';
                              }               
        
        
        
        
    }
    $db->closeDB();
                            ?>



                        </select></label>

                        <input type="submit" name="buy" value="Buy">

                    
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
