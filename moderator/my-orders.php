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

if(isset($_POST['update'])){
            
        $db = new MyDatabase();
        $c = $db->connectToDB();
                        
        $query = "UPDATE Purchases_Project SET Status=1 WHERE Id ='".$_POST['order'][0]."'";
        $select = $db->selectDB($query);
    
 
                $retrieve_user = "SELECT Customer_Name FROM Purchases_Project	 WHERE Designer_Name='".$_SESSION['username']."' AND Id='".$_POST['order'][0]."'";
                $select = $db->selectDB($retrieve_user);
                $user = mysqli_fetch_array($select);
                $retrieve_email = "SELECT email FROM Users_Project WHERE username='".$user[0]."'";
                $select = $db->selectDB($retrieve_email);
                $mail = mysqli_fetch_array($select);
                
    $db->closeDB();
    
    mail($mail[0], 'Order Status Updated', "
Your order status has changed !<br>
 
------------------------<br>
Updated by : ".$_SESSION['username']."<br>
Order #: ".$_POST['order'][0]."<br>
------------------------<br>
", "From:noreply@dgounot.hr"); // Send our email
    
    
    
    
    
            
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username'].""." has update the order #".$_POST['order'][0]."";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);

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

    <title>My Orders</title>
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

    <script src="../javascript/my_orders.js"></script>

    <!--    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

     <script src="../javascript/dgounot.js" type="text/javascript"></script> 
    <script src="../javascript/dgounot_jquery.js" type="text/javascript"></script>  -->



</head>

<body>

    <header>
        <h1 id="page_title">My Orders</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./moderator-section.php">Moderation</a></li>

    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">

            <form action="my-orders.php" method="POST" name="orders" enctype="multipart/form-data">
                
                <br><div class="title">Pending Orders</div><br>
                            <div id="responsive_table">

            <table id="table" class="display" data-page-length='7' >


                <thead>

                    <tr>
                        <th>Id</th>                        
                        <th>Template</th>
                        <th>Quantity</th>
                        <th>Title</th>
                        <th>Tagline</th>
                        <th>Content</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    
                        $db = new MyDatabase();
                        $c = $db->connectToDB();
                        
                        $query = "SELECT * FROM `Purchases_Project` WHERE Designer_Name='".$_SESSION['username']."' AND Status = '0'";
                        $select = $db->selectDB($query);
                    
                            while($result = mysqli_fetch_array($select)){


                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                
                                $retrievePath = "SELECT * FROM `Templates_Project` WHERE name ='".$result[5]."'";
                                $select2 = $db->selectDB($retrievePath);
                                while($result2 = mysqli_fetch_array($select2)){
                                    echo '<td> <a href="'.$result2[3].'" target="_blank"><img src="'.$result2[3].'" alt="'.$result2[0].'" width="100" height="100"></a> </td>';
                                }
                                echo"<td>  $result[4]  </td> ";                                
                                echo"<td>  $result[7]  </td> ";
                                echo"<td>  $result[8]  </td> ";
                                echo"<td>  $result[9]  </td> ";
                            }
                    echo'</tr>';
                        $db->closeDB();

                    ?>
                            
                </tbody>
            </table>
        </div>

                <div class="data">
                <br><div class="title">Update Order status</div><br>


                    <label>Order Id : <select id="dropdown" name="order[]" onchange="selection()" required>

                            <?php
                        
                        
                                      
                        $db = new MyDatabase();
                        $c  = $db->connectToDB();
                        
                            
                        $query    = "SELECT * FROM `Purchases_Project` WHERE Designer_Name='".$_SESSION['username']."' AND Status = '0'";
                        $select   = $db->selectDB($query); 
                        
                        
                        while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="order" value='.$result[0].'>'.$result[0].'</option>';
    }        
                            
                        
                        

    $db->closeDB();
                        ?>



                        </select></label><br>

                    <input type="submit" name="update" value="Finished">
                </div>
                
                
                <div class="data">
                
                <br><div class="title">Client List</div><br>
                            <div id="responsive_table">

            <table id="table2" class="display" data-page-length='7' >


                <thead>

                    <tr>
                        <th>Id</th>                        
                        <th>Template</th>
                        <th>Customer</th>
                        <th>Delivery Time</th>

                    </tr>

                </thead>
                <tbody>
                    <?php
                    
                        $db = new MyDatabase();
                        $c = $db->connectToDB();
                        
                        $query = "SELECT `Id`, `Template_Name`, `Customer_Name`, `Date` FROM `Purchases_Project` WHERE Designer_Name = '".$_SESSION['username']."' AND Status = 1";
                        $select = $db->selectDB($query);
                    
                            while($result = mysqli_fetch_array($select)){


                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                
                                $retrievePath = "SELECT * FROM `Templates_Project` WHERE name ='".$result[1]."'";
                                $select2 = $db->selectDB($retrievePath);
                                while($result2 = mysqli_fetch_array($select2)){
                                    echo '<td> <a href="'.$result2[3].'" target="_blank"><img src="'.$result2[3].'" alt="'.$result2[0].'" width="100" height="100"></a> </td>';
                                }
                                echo"<td>  $result[2]  </td> ";
                                
                                $now = date("Y-m-d");
    
                                                            
                                
                                

                                $date_diff = abs(strtotime($result[3]) - strtotime($now));
                                $result = floor($date_diff / (60*60*24)); // number of day between order and delivery


                                
                                echo"<td>  $result "." days  </td>";

                            }
                    echo'</tr>';
                        $db->closeDB();

                    ?>
                            
                </tbody>
            </table>
        </div>
                
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
