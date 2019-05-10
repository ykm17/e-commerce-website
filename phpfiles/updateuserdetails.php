<?php 
require 'init.php';
session_start();
$name       = $_POST["name"];
$email      = $_POST["email"];
$address    = $_POST["address"];
$city       = $_POST["city"];
$district   = $_POST["district"];
$postal     = $_POST["postal"];
$country    = $_POST["country"];
$phoneno    = $_POST["phoneno"];

$sql2 = "UPDATE user_details SET name = '".$name."',email = '".$email."',address = '".$address."',city = '".$city."',district = '".$district."',postal = ".$postal.",country = '".$country."',phoneno = ".$phoneno." WHERE id = ".$_SESSION["id"].";";

        if ($conn->query($sql2) === TRUE) {
            //echo "New record created successfully";
            echo "<script type='text/javascript'>
            location.href='../userdetails.php';
            </script>";
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }



                              
?>