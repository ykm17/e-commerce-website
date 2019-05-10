<?php
require 'init.php';

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

$message = "Password do not match !";

    if($password != $confirm_password){
        echo "<script type='text/javascript'>alert('$message');</script>";
    }else{
        $sql = "INSERT INTO user_details (name,email,password)
        VALUES ('".$name."', '".$email."', '".$password."')";
                

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            echo "<script type='text/javascript'>
            location.href='../login.php';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

?>