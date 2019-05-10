<?php
//pid id name comment star
session_start();
require 'init.php';
$pid = $_POST["pid"];
$id = $_SESSION["id"];

$username = $_SESSION["name"];
$productname = $_POST["pname"];

$review = $_POST["message"];    
$rating_star = $_POST["rating_star"];

echo $pid."  ".$id."  ".$username."  ".$productname."  ".$review."  ".$rating_star;



$sql = "INSERT INTO user_reviews(pid, id, user_name, product_name, review, rating_star) VALUES (".$pid.",".$id.",'".$username."','".$productname."','".$review."',".$rating_star.");";

                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: ../single-product.php");
                    
                } else {
                    //header("Location: ../index.php");
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
$_SESSION["pid"] = $pid;


?>