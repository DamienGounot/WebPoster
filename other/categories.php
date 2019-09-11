<?php
session_start();
include_once '../forms/timeout.php';

?>

<!DOCTYPE html>

<!--
/var/www/webdip.barka.foi.hr/2018/zadaca_02/dgounot

chmod 775 . - open
chmod 770 . - close
-->

<html lang="en">

<head>

    <title>Categories</title>
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

    <script src="../javascript/dgounot_jquery.js"></script>



</head>

<body>

    <header>
        <h1 id="page_title">Business Poster Categories</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>

        <?php
        if(!isset($_SESSION['login'])){
            
            echo'<li><a href="../forms/login.php">Login</a></li>';    
            echo'<li><a href="../forms/registration.php">Registration</a></li>';
        }
        
        if(isset($_SESSION['type']) && $_SESSION['type']!=1 && $_SESSION['type']!=2){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../registered/make-purchase.php">Purchase</a></li>';
            echo'<li><a href="../registered/my-purchases.php">History</a></li>';
            echo'<li><a href="../registered/my-points.php">Points</a></li>';
            echo'<li><a href="../registered/available-vouchers.php">Vouchers</a></li>';
            
        }
        ?>


        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 2 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';
            echo'<li><a href="../registered/make-purchase.php">Purchase</a></li>';
            echo'<li><a href="../registered/my-purchases.php">History</a></li>';
            echo'<li><a href="../registered/my-points.php">Points</a></li>';            
            echo'<li><a href="../registered/available-vouchers.php">Vouchers</a></li>';
           
        }
        
        ?>

        <?php
        if(isset($_SESSION['type']) && $_SESSION['type'] == 1 ){
            
            echo'<li><a href="../forms/logout.php">Logout</a></li>';
            echo'<li><a href="../admin/admin-section.php">Administration</a></li>';
            echo'<li><a href="../moderator/moderator-section.php">Moderation</a></li>';            
            echo'<li><a href="../registered/make-purchase.php">Purchase</a></li>';
            echo'<li><a href="../registered/my-purchases.php">History</a></li>';
            echo'<li><a href="../registered/my-points.php">Points</a></li>';            
            echo'<li><a href="../registered/available-vouchers.php">Vouchers</a></li>';
           
        }
        
        ?>

    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">

                <br><div class="data">
                <form action="categories.php" method="POST" name="formulaire" enctype="multipart/form-data">


                     <label>Select a Categorie : <select id="dropdown" name="categorie[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();
    $query    = "SELECT * FROM Categories_Project ORDER BY name";
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="categorie" value='.$result[0].'>'.$result[0].'</option>';
        
    }
    $db->closeDB();
                            ?>



                        </select></label>

                        <input type="submit" name="refresh" value="Refresh">
                                    </form>

                </div>

        
                        <div id="responsive_table">

            <div style="text-align:center;">


            </div>


            <table id="table" class="display" data-page-length='3'>
                
                    <br><div class="title">Tops Templates in the categorie</div><br>

                <thead>

                    <tr>
                        <th>Template Name</th>
                        <th>Template</th>
                        <th>Number of Purchases</th>
                    </tr>

                </thead>
                <tbody>


                    <?php

    include_once '../forms/database-class.php';
    $db = new MyDatabase();
    $c = $db->connectToDB();
                    
                    if(isset($_POST['refresh'])){
                        
                        $query = "SELECT name FROM Templates_Project WHERE categorie='".$_POST['categorie'][0]."' ORDER BY name";
                        $select = $db->selectDB($query);
                                                
                        
                            while($templatesname = mysqli_fetch_array($select)){   // on recupere les templates de la categorie
                                
                                
                                $retrievePath = "SELECT * FROM `Templates_Project` WHERE name = '".$templatesname[0]."'";
                                        $selectpath = $db->selectDB($retrievePath);
                                    while($path = mysqli_fetch_array($selectpath)){
                                                                                
                                        
                                        $count="SELECT COUNT(*) FROM Purchases_Project WHERE Template_Name='".$templatesname[0]."'";
                                        $selectcount = $db->selectDB($count);
                                        while($countranking = mysqli_fetch_array($selectcount)){
                                            
                                    if($countranking[0] == 0){
                                        
                                    }else{        
                                            
                                            
                                echo'<tr>';
                                echo"<td>  $templatesname[0]  </td> ";
                                echo"<td> <img src='".$path[3]."' alt ='".$templatesname[0]."' width='100' height='100' ></td>";
                                echo"<td>  $countranking[0] </td> ";
                                echo'</tr>';


                                    }
                                        }
                                        
                                
                                    }
                                
                            }
                        
                  
                                                
                    }
                    
                    



$db->closeDB();
?>


                </tbody>
            </table>




        </div>
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
