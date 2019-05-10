<?php

session_start();
    
    require 'init.php';
    $pid = $_GET["pid"];    
    
    $sql = "SELECT * FROM product_details WHERE pid =".$pid.";";
    echo $sql."<br><br>";
    $result = $conn->query($sql);

    if(!isset($_SESSION['counter'])){
        $i=0;
        echo "not set";
    }else{
        $i=$_SESSION['counter'];
        echo "location got: ".$i."<br>";
    }

    

if($pid <> null){
    
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $found = 0;
            
            for($k=0;$k<$_SESSION['counter'];$k = $k+7){
                if( 
                    $_SESSION['wish_list'][$k]   == $row["name"] && 
                    $_SESSION['wish_list'][$k+1] == $row["description"] &&
                    $_SESSION['wish_list'][$k+2] == $row["cost"] &&
                    $_SESSION['wish_list'][$k+3] == $row["type"] &&
                    $_SESSION['wish_list'][$k+4] == $row["availability"] &&
                    $_SESSION['wish_list'][$k+5] == $row["img"] &&
                    $_SESSION['wish_list'][$k+6] == $row["pid"]
                ){
                    echo "match found";
                    header("Location: ../".$_SESSION["redirectionflag"]);
                    $found++;
                    break;
                }
            }
            echo "----------------------------------found".$found;
            if($found == 0){
                echo "no match";
            $_SESSION['wish_list'][$i] =   $row["name"];
            $_SESSION['wish_list'][$i+1] = $row["description"];    
            $_SESSION['wish_list'][$i+2] = $row["cost"];
            $_SESSION['wish_list'][$i+3] = $row["type"]; 
            $_SESSION['wish_list'][$i+4] = $row["availability"];
            $_SESSION['wish_list'][$i+5] = $row["img"];
            $_SESSION['wish_list'][$i+6] = $row["pid"];
            
            
            echo $_SESSION['wish_list'][$i+6];
            $_SESSION['counter'] = $i+7;
            
            echo "<br>location updated: ".$_SESSION['counter']."<br>";
                header("Location: ../".$_SESSION["redirectionflag"]);
            }
            
     
            /*
            echo $_SESSION['wishlist'][$i]."<br>";
            echo $_SESSION['wishlist'][$i+1]."<br>";
            echo $_SESSION['wishlist'][$i+2]."<br>";
            echo $_SESSION['wishlist'][$i+3]."<br>";
            echo $_SESSION['wishlist'][$i+4]."<br>";*/
        }
    }
}

    /*$_SESSION['wish-list']=base64_encode(serialize($data));
    $data2 =  unserialize(base64_decode($_SESSION['wish-list']));
    */


?>