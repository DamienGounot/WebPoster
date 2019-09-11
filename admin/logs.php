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

<!DOCTYPE html>

<!--
/var/www/webdip.barka.foi.hr/2018/zadaca_02/dgounot

chmod 775 . - open
chmod 770 . - close
-->

<html lang="en">

<head>
    <title>Logs</title>

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



</head>

<body>

    <header>
        <h1 id="page_title">Logs</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./admin-section.php">Administration</a></li>
    </menu>




    <div class="container">
        <div class="center"></div>



        <div id="responsive_table">

            <div style="text-align:center;"><input type="button" onclick="window.print();return false;" value="Print"></div>

            <table id="table" class="display" data-page-length='7'>


                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>


                    <?php
                        if (file_exists('../logs/log.csv')){
$file = fopen("../logs/log.csv","r");

while(! feof($file))
  {
  $print = (fgetcsv($file,0,';'));

                                echo'<tr>';
                                echo"<td>  $print[0]  </td> ";
                                echo"<td>  $print[1]  </td> ";
                                echo"<td>  $print[2]  </td> ";
                                echo'</tr>';  }

fclose($file);
}
?>


                </tbody>
            </table>
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
