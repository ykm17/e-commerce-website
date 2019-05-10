<?php
require 'init.php';
$id = $_GET['id'];
$pid = $_GET['product_id'];

$sql = "DELETE FROM user_cart WHERE id=".$id." AND pid=".$pid.";";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: ../cart.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>