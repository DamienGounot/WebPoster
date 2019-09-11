<?php
session_start();
$username = $_SESSION['username'];


        $text="".$username." logout";
        $fp = fopen("../logs/log.csv", "a+");
        $date = date("d.m.Y;H:i:s");
        fwrite($fp, $date.";".$text."\n");
        fclose($fp); 

session_destroy();

header("Location: ../index.php");
exit;
?>
