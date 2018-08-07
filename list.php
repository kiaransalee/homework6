<?php 
$dir = "./tests";
    if($handle = opendir($dir)){

        while(false !== ($file = readdir($handle))) {
            if($file != "." && $file != ".."){
            echo "<a href='test.php?test=" . $file . "'>" . $file . "</a>" . "<br>";
        }
    }
}