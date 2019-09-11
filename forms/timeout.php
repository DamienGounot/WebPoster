<?php
$time = $_SERVER['REQUEST_TIME'];

/**
* for timeout, specified in seconds
*/
include_once 'database-class.php';
$db = new MyDatabase();
$c  = $db->connectToDB();

$timeout_duration = 600; // 10 minutes timeout

/**
* Here we look for the user's LAST_ACTIVITY timestamp. If
* it's set and indicates our $timeout_duration has passed,
* blow away any previous $_SESSION data and start a new one.
*/
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    
    if(isset($_SESSION['username'])){
        
        $text="".$_SESSION['username']." timeout";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp); 
    }

    
    
    session_destroy();
}

/**
* Finally, update LAST_ACTIVITY so that our timeout
* is based on it and not the user's login time.
*/
$_SESSION['LAST_ACTIVITY'] = $time;
?>
