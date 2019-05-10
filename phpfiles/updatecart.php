<?php
session_start();
require 'init.php';

//$array = unserialize(base64_decode($_GET["input_name"]));
//$count = $_GET["count"];

$id = $_GET["id"];
$pid = $_GET["pid"];
$name = $_GET["name"];
$cost = $_GET["cost"];
$newquantity = $_GET["quantity"];

$sql = "UPDATE user_cart SET quantity = ".$newquantity." WHERE id = ".$id." AND pid = ".$pid."";
        if ($conn->query($sql) === TRUE) {
            echo "Updated";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

?>