<?php 
session_start();
for($k=0;$k<$_SESSION['counter'];$k = $k+7){
            echo $_SESSION['wish_list'][$k]."<br>";
            echo $_SESSION['wish_list'][$k+1]."<br>";
            echo $_SESSION['wish_list'][$k+2]."<br>";
            echo $_SESSION['wish_list'][$k+3]."<br>";
            echo $_SESSION['wish_list'][$k+4]."<br>";
            echo $_SESSION['wish_list'][$k+5]."<br>";
            echo $_SESSION['wish_list'][$k+6]."<br>";

    }
?>