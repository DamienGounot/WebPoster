<?php

    function logText($text){
        $fp = fopen("log.txt", "a+");
        $date = date("d.m.Y H:i:s");
        fwrite($fp, $date." ".$text."\n");
        fclose($fp);
    }
    
    function readLog(){
        $fp = fopen("log.txt", "r");
        $contents = fread($fp, filesize("log.txt"));
        fclose($fp);
        return $contents;
    }
    
    function readLogForWeb(){
        $c = readLog();
        return str_replace("\n", "<br/>", $c);
    }
?>