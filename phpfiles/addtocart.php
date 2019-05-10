<?php
session_start();
require 'init.php';
$id = $_SESSION["id"];
        
echo $_SESSION["redirectionflag"];

if($_SESSION["redirectionflag"] == "wish-list.php"){
    /*echo "<script type='text/javascript'>
            alert();
            </script>";
    */
    for($k=0;$k<$_SESSION['counter'];$k = $k+7){
        
            if($_SESSION['wish_list'][$k+6] <> null){    
                $pid = $_SESSION['wish_list'][$k+6];
                $quantity = 1;

                $sql = "INSERT INTO user_cart(id,pid,date,quantity)
                VALUES ( ".$id." , ".$pid." , CURDATE() , ".$quantity." )";


                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";

                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        
    }
        unset($_SESSION['wish_list']);
    unset($_SESSION['counter']);
    echo "<script type='text/javascript'>
            location.href='../cart.php';
            </script>";

}else{

        $pid = $_GET["pid"];
        $quantity = $_GET["quantity"];

        $sql = "INSERT INTO user_cart(id,pid,date,quantity)
        VALUES ( ".$id." , ".$pid." , CURDATE() , ".$quantity." )";


        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            echo "<script type='text/javascript'>
            location.href='../cart.php';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
}

?>