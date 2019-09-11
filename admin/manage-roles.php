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
$user = 0;
$role = 0;

		if(isset($_POST["submit"])) 
		{
        
            if(isset($_POST["users"])){
			foreach ($_POST['users'] as $subject) {
                $user ++;

            }
            }

            if($user == 0){
                echo'<script>alert("You must select a user !");</script>';
                $verif_user= false;

            }else{
                    $verif_user = true;

                    
                }
            
            if(isset($_POST["role"])){
			foreach ($_POST['role'] as $subject) {
                $role ++;

            }
            }

            if($role == 0){
                echo'<script>alert("You must assign a Role !");</script>';
                $verif_role = false;

            }else{
                    $verif_role = true;

                    
                }
            
            
            if($verif_user && $verif_role){
                
                $db = new MyDatabase();
                $c  = $db->connectToDB();
                
  
            $query = "UPDATE Users_Project SET type = '".$_POST['role'][0]."' WHERE username='".$_POST['users'][0]."'";
                
    $result   = $db->selectDB($query);
    $db->closeDB();
                        echo'<script>alert("You Successfully change the role!");</script>';
        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "".$_SESSION['username']." has change the role of ".$_POST['users'][0]." to ".$_POST['role'][0]."";
//fwrite($fp, $date.";Query : ".$query."\n");
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

    <title>Manage Roles</title>
    <meta charset="UTF-8">
    <meta name="author" content="Damien">
    <meta name="description" content="registration">
    <meta name="keywords" content="form,infos,personnal">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/dgounot.css" rel="stylesheet" type="text/css">
    <link href="../css/dgounot_480.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 480px)">
    <link href="../css/dgounot_1024.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 1024px)">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<!DOCTYPE html>

<!--
/var/www/webdip.barka.foi.hr/2018/zadaca_02/dgounot

chmod 775 . - open
chmod 770 . - close
-->

<html lang="en">

<head>

    <title>Manage Roles</title>
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
        <h1 id="page_title">Manage Roles</h1>
        <img src="../multimedia/image/foi-logo.jpg" alt="FOI Logo" width="100">
    </header>

    <menu>
        <li><a href="../index.php">Index</a></li>
        <li><a href="./admin-section.php">Administration</a></li>
    </menu>




    <div id="login">
        <div class="center"></div>

        <div class="field">

            <form action="manage-roles.php" method="POST" name="formulaire" enctype="multipart/form-data">



                <div class="data">


                    <label>Select User : <select id="dropdown" name="users[]" onchange="selection()" required>

                            <?php
$db = new MyDatabase();
$c  = $db->connectToDB();
    $query    = "SELECT * FROM Users_Project";
    $select   = $db->selectDB($query);
    while($result = mysqli_fetch_array($select)){
        
        
        echo '<option name="users" value='.$result[0].'>'.$result[0].'</option>';
    }
    $db->closeDB();
                            ?>



                        </select></label><br>

                    <label>Assign a Role : <select id="dropdown" name="role[]" onchange="selection()" required>
                            <option name="role" value="1">admin</option>
                            <option name="role" value="2">moderator</option>
                            <option name="role" value="3">user</option>
                        </select></label><br>


                </div>



                <div class="data">
                    <input type="submit" name="submit" value="Submit" id="submit">
                </div>
                

            </form>
        </div>
        
                    <div class="field">
                        <div id="responsive_table">

            <div style="text-align:center;">
                <form action="manage-roles.php" method="POST" name="formulaire" enctype="multipart/form-data">
                    <select id="filter" name="filter">
                        <option name="filer" value="All">All</option>
                        <option name="filer" value="User">User</option>
                        <option name="filer" value="Moderator">Moderator</option>
                        <option name="filer" value="Admin">Admin</option>

                        <input type="submit" name="filterbtn" value="Filter" id="submit">
                </form>

            </div>


            <table id="table" class="display" data-page-length='7'>


                <thead>

                    <tr>
                        <th>User</th>
                        <th>role</th>
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
                                
                                
                                if($result[4] == 1){
                                    
                                    echo"<td>  Admin  </td> ";

                                }
                                
                                if($result[4] == 2){
                                
                                    echo"<td>  Moderator  </td> ";

                                }
                                
                                if($result[4] == 3){
                                    
                                echo"<td>  Normal User  </td> ";
                
                                }
                                
                                echo'</tr>';


                                    }

            }
                        
                        if($_POST['filter'] =="User"){
                            
                        $query = "SELECT * FROM Users_Project WHERE type='3'";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){

                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  Normal user  </td> ";
                                echo'</tr>';


                                    }
                            
                        }
                       if($_POST['filter'] =="Moderator"){
                           
                        $query = "SELECT * FROM Users_Project WHERE type='2'";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){

                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  Moderator </td> ";
                                echo'</tr>';

                                    }                           
                            
                        }
                        
                    if($_POST['filter'] =="Admin"){
                        
                        $query = "SELECT * FROM Users_Project WHERE type='1'";
                        $select = $db->selectDB($query);
                            while($result = mysqli_fetch_array($select)){


                                echo'<tr>';
                                echo"<td>  $result[0]  </td> ";
                                echo"<td>  Admin  </td> ";
                                echo'</tr>';


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
