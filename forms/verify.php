<?php
session_start();

include_once 'timeout.php';
include_once 'database-class.php';

$db = new MyDatabase();
$c  = $db->connectToDB();


             
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                    
    $query    = "SELECT * FROM Users_Project WHERE email='" . $_GET['email'] . "' AND hash='" . $_GET['hash'] . "'";
    
    $clic = date("Y-m-d H:i:s");

    
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_array($result);
    $number   = mysqli_num_rows($result);
    
    if ($number == 0) {
            
            header("Location: ../index.php");
            exit();
        
    }else{
        
        $registrationtime = strtotime($user[10]);
        $clictime = strtotime($clic);

        if($clictime - $registrationtime < 25200){ // if less than 7 hours
            

                
        
        $query = "UPDATE Users_Project SET status = '1' WHERE email='".$_GET['email']."' AND hash='".$_GET['hash']."' AND status='0'";
  
        
    $result   = $db->selectDB($query);
    $user     = mysqli_fetch_assoc($result);
    $db->closeDB();
        
        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "The account with the email : ".$_GET['email']." has been activated !";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
        
                   header("Location: ../forms/login.php");
                    exit();
        
    }else{
                        
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        $text = "The account with the email : ".$_GET['email']." has not been activated because 7h delay reached !";
        fwrite($fp, $date.";".$text."\n");
        fclose($fp);
            
            header("Location: ../index.php");
            exit();
            
            
        }
    }
}
?>
