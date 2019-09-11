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



            if(isset($_POST['submit'])){
                
                if(empty($_POST['title'])){
                $verif_title = false;
            }else{
                $verif_title = true;

                }

                if(empty($_POST['tagline'])){
                    $verif_tag = false;
                    
                }else{
                    $verif_tag = true;
                }

            if(empty($_POST['quantity'])){
                
                $verif_quantity = false;
            }else{
                
                if(!is_numeric($_POST['quantity'])){
                                    $verif_quantity = false;

                }else{
                                    $verif_quantity = true;

                }
            }
                
                
                if(empty($_POST['content'])){
                    
                    $verif_content = false;
                }else{
                    $verif_content = true;
                }
                
                
                
                if($verif_title && $verif_tag && $verif_quantity && $verif_content){
                        
                        $db = new MyDatabase();
                        $c = $db->connectToDB();
                        $template = preg_replace('/\s/', '', $_POST['template'][0]);

                    
                    
                    $retrieve_maker = "SELECT creator FROM `Templates_Project` WHERE name='".$template."'";
                    $result   = $db->selectDB($retrieve_maker);
                    $user     = mysqli_fetch_array($result);
                    $date = date("Y-m-d");

                    
                    
                    
                    $insertQuery = "INSERT INTO `Purchases_Project`( `Status`, `Customer_Name`, `Designer_Name`, `quantity`, `Template_Name`, `Date`,`Customer_Title`,`Customer_Tagline`,`Customer_Content`) VALUES ('0','".$_SESSION['username']."','".$user[0]."','".$_POST['quantity']."','".$template."','".$date."','".$_POST['title']."','".$_POST['tagline']."','".$_POST['content']."')";
 
                    mysqli_query($c, $insertQuery);
                    
                        $query_points = "SELECT points FROM Users_Project WHERE username='".$_SESSION['username']."'";
                        $select_points = $db->selectDB($query_points);
                        $result_points = mysqli_fetch_array($select_points);
                        $my_points = $result_points[0];
                        $query_price = "SELECT price FROM Templates_Project WHERE name='".$template."'";
                        $select_price = $db->selectDB($query_price);
                        $result_price = mysqli_fetch_array($select_price);
                        $my_price = $result_price[0]; 
                    
                        $maj_point = $my_points + (($_POST['quantity']*$my_price)/10);
                        $update_points = "UPDATE `Users_Project` SET points='".$maj_point."' WHERE username ='".$_SESSION['username']."'"; 
                        $update = $db->selectDB($update_points);
                    
                    
                    $db->closeDB();
                    
                    echo'<script>alert("Your order is in progress");</script>';
                    
                            $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username']." has order the template ".$template." ".$_POST['quantity']." times";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);

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

    <title>Purchase template</title>
    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="registration">
    <meta name="keywords" content="form,infos,personnal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    

    
    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js">
    </script>

    <script src="../javascript/dgounot_jquery.js"></script>
        <script src="../javascript/make_purchase.js"></script>

    
    
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">


</head>

<body>

    <header>
        <h1 id="page_title">Purchase Template</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 3 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./my-points.php">Points</a></li>';
            echo'<li><a href="./available-vouchers.php">Vouchers</a></li>';
            
        }
        
        ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 2 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./my-points.php">Points</a></li>';
            echo'<li><a href="./available-vouchers.php">Vouchers</a></li>';
           
        }
        
        ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 1 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../other/categories.php">Categories</a></li>';
            echo'<li><a href="../admin/admin-section.php">Administration</a></li>';            
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';
            echo'<li><a href="./my-purchases.php">History</a></li>';
            echo'<li><a href="./my-points.php">Points</a></li>';
            echo'<li><a href="./available-vouchers.php">Vouchers</a></li>';
           
        }
        
        ?>



    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">
            
            

            <form action="make-purchase.php" method="POST" name="formulaire" enctype="multipart/form-data">
<br><div class="title">Available Templates</div><br>
                            <div id="responsive_table">

            <table id="table" class="display" data-page-length='7' >


                <thead>

                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Categorie</th>
                        <th>Template</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    
                        $db = new MyDatabase();
                        $c = $db->connectToDB();
                        
                        $query = "SELECT * FROM `Templates_Project`";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){


                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  $result[1]  </td> ";
                                echo"<td>  $result[2]  </td> ";
                                echo"<td>  $result[4]  </td> ";
                                
                            $name_parts = explode('.', $result[3]);
                            $file_ext = strtolower(end($name_parts));
                                

                                    echo '<td> <a href="'.$result[3].'" target="_blank"><img src="'.$result[3].'" alt="'.$result[0].'" width="100" height="100"></a> </td>';
                            }
                    echo'</tr>';
                        $db->closeDB();

                    ?>
                            
                </tbody>
            </table>
        </div>

                <div class="data">
                <br><div class="title">Fill out your template infos</div><br>

                    <label>Title: <input id="title" name="title" onkeyup="checkPurchase();" required></label> <br>
                    <label>TagLine: <input id="tagline" name="tagline" onkeyup="checkPurchase();" required></label> <br>
                    <label>Quantity: <input min="0" type="number" id="quantity" name="quantity" onkeyup="checkPurchase();" required></label> <br>

                    <label>Content:</label> <textarea id="content" name="content" rows="3" cols="40" onclick="textArea();" onKeyPress="limitText(this.form.limitedtextarea,this.form.countdown);" onblur="limitText(this.form.limitedtextarea,this.form.countdown);" onkeyup="checkPurchase();" required></textarea><br>


                    <label>Select a template : <select id="dropdown" name="template[]" onchange="selection()" required>

                            <?php
                        
                        
                                      
                        $db = new MyDatabase();
                        $c  = $db->connectToDB();
                        
                            
                        $query    = "SELECT * FROM `Templates_Project` ORDER BY name";
                        $select   = $db->selectDB($query);        
                        while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="template" value='.$result[0].'>'.$result[0].'</option>';
    }        
                            
                        
                        

    $db->closeDB();
                        ?>



                        </select></label><br>

                    <input type="submit" name="submit" value="Order Now" id="order" onclick="return checkPurchase();">
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
