<?php 
require 'init.php';
session_start();
$data = unserialize(base64_decode($_POST["input_name"]));
/*
                $data[$i] = $row["id"];
                $data[$i+1] = $row["pid"];
                $data[$i+2] = $row["name"];
                $data[$i+3] = $row["cost"];
                $data[$i+4] = $row["quantity"];
                                
*/
$name       = $_POST["name"];
$email      = $_POST["email"];
$address    = $_POST["address"];
$city       = $_POST["city"];
$district   = $_POST["district"];
$postal     = $_POST["postal"];
$country    = $_POST["country"];
$phoneno    = $_POST["phoneno"];

$sql2 = "UPDATE user_details SET name = '".$name."',email = '".$email."',address = '".$address."',city = '".$city."',district = '".$district."',postal = ".$postal.",country = '".$country."',phoneno = ".$phoneno." WHERE id = ".$data[0].";";

        if ($conn->query($sql2) === TRUE) {
            //echo "New record created successfully";
            /*echo "<script type='text/javascript'>
            location.href='../.php';
            </script>";*/
        } else {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }


$k=0;
$orderid = rand(1,100000);
check($orderid);
    
for($i=0;$i<count($data)/6;$i++){
    //echo $data[$k]."   --   ".$data[$k+4];   
    $_SESSION['orderid'] = $orderid; 
    
    $sql = "INSERT INTO order_placed(oid,id, pid, name, cost, qty ,date,status) VALUES  ( ".$orderid." ,".$data[$k]." , ".$data[$k+1].", '".$data[$k+2]."' , ".$data[$k+3]." , ".$data[$k+4].", CURDATE(), 'on the way');";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            /*location.href='../confirmation.php';
            echo "<script type='text/javascript'>
            </script>";*/
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    //delete from cart
    
    $sql2 ="DELETE FROM user_cart WHERE kid=".$data[$k+5].";";
        if ($conn->query($sql2) === TRUE) {
            //echo "New record created successfully";
            echo "<script type='text/javascript'>
            location.href='../confirmation.php';
            </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
$k = $k + 6;

}

function check($orderid){
    require 'init.php';
    $sql = "SELECT oid from order_placed";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $found = 0;
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($orderid == $row["oid"])
            { 
                $found++;
                break;
            }
            
        }
        if($found == 0){
            return true;
        } 
        else {
            $orderid = rand(1,100000);
            check($orderid);
        }
    }
}

                              
?>