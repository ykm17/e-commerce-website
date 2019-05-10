<?php
    session_start();
    $no = $_GET["product_id"];
    
    $_SESSION['wish_list'][$no]=null;  
    $_SESSION['wish_list'][$no+1]=null;
    $_SESSION['wish_list'][$no+2]=null;
    $_SESSION['wish_list'][$no+3]=null;
    $_SESSION['wish_list'][$no+4]=null;
    $_SESSION['wish_list'][$no+5]=null;
    $_SESSION['wish_list'][$no+6] == null;
    $p=0;
    /*
    for($k=0;$k<$_SESSION['counter'];$k = $k++){
    
            if($_SESSION['wish_list'][$k] <> null){ $p++;break;}
    }
    
    if($p ==  0) unset($_SESSION['wish_list']);
      echo $p;
        */
    header("Location: ../wish-list.php");
?>