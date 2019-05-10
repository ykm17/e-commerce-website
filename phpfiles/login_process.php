<?php
require 'init.php';
session_start();

$email = $_POST["email"];
$password = $_POST["password"];     
$redirectionflag = $_POST["redirectionflag"];
$sql = "SELECT * FROM user_details";
$result = $conn->query($sql);
$found = 0;


$message = "Login Successful !";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        if($email == $row["email"] && $password == $row["password"]){
            #found      
            echo "<script type='text/javascript'>
            alert('$message');
            location.href='../".$redirectionflag."';
            </script>";
            $_SESSION["name"] = $row["name"];    
            $_SESSION["email"] = $row["email"];  
            $_SESSION["id"] = $row["id"];
            $found = 1;
            break;
        }    
        
    }
    if($found == 0){
        $message2 = "Wrong Details !";
        echo "<script type='text/javascript'>
        alert('$message2');
        location.href='../".$redirectionflag."';
        </script>";
            
        #wrong
    }
} else {
    echo "0 results";
}

?>