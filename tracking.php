<!doctype html>
<html lang="en">
<?php 
    session_start();
    require 'phpfiles/init.php';
$full_path = pathinfo($_SERVER['PHP_SELF']);
    $current_filename = $full_path['basename'];
    $_SESSION["redirectionflag"] = $current_filename;    
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <title>Fashiop</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
  
    
</head>

<body>

    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="top_menu row m0">
            <div class="container-fluid">
                <div class="float-left">
                    <p>Call Us: 012 44 5698 7456 896</p>
                </div>
                <div class="float-right">
                    <ul class="right_side">
                        <?php
                            if(isset($_SESSION["email"])){
                                echo "
                                  <li>
							         <a href=\"#\" style=\"text-transform: initial;\">
								        ".$_SESSION["email"]."
							         </a>
						          </li>";        
                            }else{
                                echo "<li>
							         <a href=\"login.php\">
								        Login/Register
                                     </a>
						          </li>";
                            } 
                        ?>
                        <li>
                            <a href="contact.php">
                                Contact Us
                            </a>
                        </li>
                        <?php if(isset($_SESSION["email"])){ ?>
                        <li>
							<a href="phpfiles/logout.php">
								Logout
							</a>
						</li>
					    <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php require 'header.php'; ?>
    </header>
    <!--================Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <br><br>
    <!--================End Home Banner Area =================-->

    <!--================Tracking Box Area =================-->
    <section class="tracking_box_area p_120">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-7">
                        <p>To track your order please enter your Order ID in the box below and press the "Track"        button. This was given
                            to you on your receipt and in the confirmation email you should have received.</p>
                                <form class="row tracking_form" method="get" action="tracking.php" >
                                    <div class="col-md-6 form-group">
                                        <input type="number" class="form-control" id="oid" name="oid" placeholder="Order ID" required>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <button type="type"  id="btn1" value="submit" class="btn submit_btn">Track Order</button>
                                    </div>
                                </form>                    
                    </div> 
                        <!--ADD HERE RESULTS -->
                    
                    <?php
                        require 'phpfiles/init.php';
                    
                    if(isset($_GET['oid'])){
                        $oid = $_GET['oid'];    
                    
                        if($oid <> null){
                        

                            $sql4 = "SELECT * FROM order_placed WHERE oid = ".$oid.";";
                            $result4 = $conn->query($sql4);


                    ?>
                        <!-- -->
                        <div class="col-lg-5">
                            <div class="order_box">

                                <h2>Your Order No: <?php echo $oid; ?></h2>

                                <ul class="list">
                                    <li>
                                        <a href="#">Product
                                            <span>    Total</span>
                                        </a>
                                    </li>
                                    <?php 

                                        if ($result4->num_rows > 0) {
                                    // output data of each row
                                            $total = 0;
                                            while($row2 = $result4->fetch_assoc()) {
                                                $status = $row2["status"];    

                                                $total = $total + ($row2["cost"]*$row2["qty"]);
                                    ?>
                                    <li>
                                        <a href="#"><?php echo $row2["name"]; ?>
                                            <span class="middle">x <?php echo $row2["qty"]; ?></span>
                                            <span class="last">₹<?php echo ($row2["qty"]*$row2["cost"]); ?>.00</span>
                                        </a>
                                    </li>

                                    <?php 
                                            }
                                        }
                                    ?>

                            </ul>
                                <?php if ($result4->num_rows > 0) { ?>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal
                                            <span>₹<?php echo $total?>.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Shipping
                                            <span>Flat rate: ₹50.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Total
                                            <span>₹<?php echo ($total + 50); ?>.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Status:
                                            <span><?php echo $status; ?></span>
                                        </a>
                                    </li>
                                </ul>
                                <?php }else{ ?>
                                <ul class="list list_3">
                                    <li>
                                        <a href="#">No such order found !
                                            
                                        </a>
                                    </li>
                                </ul>
                                
                                
                                
                                
                                <?php }?>
                            </div>
                        </div>
                        <?php }
                        }
                    ?>
                
                
                </div>
            </div>
        </div>
    </section>
    <!--================End Tracking Box Area =================-->
    <section>

    </section>
    <!--================ start footer Area  =================-->
    <?php require 'footer.php'; ?>
    <!--================ End footer Area  =================-->




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stellar.js"></script>
    <script src="vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="vendors/isotope/isotope-min.js"></script>
    <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="vendors/jquery-ui/jquery-ui.js"></script>
    <script src="vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendors/counter-up/jquery.counterup.js"></script>
    <script src="js/theme.js"></script>
    <script>
    
    function isUserLoggedIn(){
            var data = "<?php if(isset($_SESSION["id"]))echo true; else echo false; ?>";
            //alert(data);
            if(data==1){
                //user is logged in, go ahead
                location.href='cart.php';
                //document.getElementById('my_form').submit();
            }else{
                //prompt user to login
                alert("Please login to load your cart !");
                location.href='login.php';
                
            }
        }
        
        function isUserLoggedIn2(){
            var data = "<?php if(isset($_SESSION["id"]))echo true; else echo false; ?>";
            //alert(data);
            if(data==1){
                //user is logged in, go ahead
                location.href='userdetails.php';
                //document.getElementById('my_form').submit();
            }else{
                //prompt user to login
                alert("Please login to load your cart !");
                location.href='login.php';
                
            }
        }
        function isUserLoggedInPast(){
            var data = "<?php if(isset($_SESSION["id"]))echo true; else echo false; ?>";
            //alert(data);
            if(data==1){
                //user is logged in, go ahead
                location.href='pastorder.php';
                //document.getElementById('my_form').submit();
            }else{
                //prompt user to login
                alert("Please login to load your cart !");
                location.href='login.php';
                
            }
        }
    
        
    
    </script>
       
</body>

</html>