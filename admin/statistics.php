<?php
session_start();
include_once '../forms/timeout.php';


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

    include_once '../forms/database-class.php';

$db = new MyDatabase();
$c  = $db->connectToDB();

if(isset($_POST['filter']) && $_POST['filter'] == "All"){$query = "SELECT * FROM Users_Project";}
if(isset($_POST['filter']) && $_POST['filter'] == "Admin"){$query = "SELECT * FROM Users_Project WHERE type='1'";}
if(isset($_POST['filter']) && $_POST['filter'] == "Moderator"){$query = "SELECT * FROM Users_Project WHERE type='2'";}
if(isset($_POST['filter']) && $_POST['filter'] == "User"){$query = "SELECT * FROM Users_Project WHERE type ='3'";}
    
if(isset($_POST['filter'])){
    
        $select   = $db->selectDB($query);
    $dataPoints = array();

    while($result = mysqli_fetch_array($select)){
        
        
    array_push($dataPoints, array("label"=> "$result[0]", "y"=> $result[6]));

    }
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
    <title>Statistics</title>

    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="list">
    <meta name="keywords" content="table,add,content">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />




    <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js">
    </script>

    <script src="../javascript/dgounot_jquery.js"></script>


    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print">

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "dark1",
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Users Statistic"
                },
                subtitles: [{
                    text: "Number of Actual Points"
                }],
                data: [{
                    type: "pie",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "#percent%",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }

    </script>

</head>

<body>

    <header>
        <h1 id="page_title">Statistics</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./admin-section.php">Administration</a></li>
    </menu>




    <div class="container">
        <div class="center"></div>



        <div id="responsive_table">

            <div style="text-align:center;">
                <form action="statistics.php" method="POST" name="formulaire" enctype="multipart/form-data">
                    <select id="filter" name="filter">
                        <option name="filer" value="All">All</option>
                        <option name="filer" value="User">User</option>
                        <option name="filer" value="Moderator">Moderator</option>
                        <option name="filer" value="Admin">Admin</option>

                        <input type="submit" name="submit" value="Filter" id="submit">
                </form>

                <input type="button" onclick="window.print();return false;" value="Print">
            </div>


            <table id="table" class="display" data-page-length='7'>


                <thead>

                    <tr>
                        <th>User</th>
                        <th>Points</th>
                        <th>TotalSpend</th>
                    </tr>

                </thead>
                <tbody>


                    <?php

    include_once '../forms/database-class.php';
    $db = new MyDatabase();
    $c = $db->connectToDB();
                    
                    if(isset($_POST['filter'])){

                        if($_POST['filter'] == "All"){
                            
                        $query = "SELECT * FROM Users_Project";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){


                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  $result[6]  </td> ";
                                echo"<td>  $result[7]  </td> ";
                                echo'</tr>';


                                    }

            }
                        
                        if($_POST['filter'] =="User"){
                            
                        $query = "SELECT * FROM Users_Project WHERE type='3'";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){

                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  $result[6]  </td> ";
                                echo"<td>  $result[7]  </td> ";
                                echo'</tr>';


                                    }
                            
                        }
                       if($_POST['filter'] =="Moderator"){
                           
                        $query = "SELECT * FROM Users_Project WHERE type='2'";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){

                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  $result[6]  </td> ";
                                echo"<td>  $result[7]  </td> ";
                                echo'</tr>';

                                    }                           
                            
                        }
                        
                    if($_POST['filter'] =="Admin"){
                        
                        $query = "SELECT * FROM Users_Project WHERE type='1'";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){


                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  $result[6]  </td> ";
                                echo"<td>  $result[7]  </td> ";
                                echo'</tr>';


                                    }                              
                        }                        
                    }
                    
                    



$db->closeDB();
?>


                </tbody>
            </table>




        </div>


        <div class="center"></div>
        <div id="chartContainer" style="height: 500px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

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
