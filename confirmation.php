<!doctype html>
<html lang="en">

<?php
session_start();
require 'phpfiles/init.php';

$full_path = pathinfo($_SERVER['PHP_SELF']);
    $current_filename = $full_path['basename'];
    $_SESSION["redirectionflag"] = $current_filename;
    
$id = $_SESSION["id"];
$total = 0;    
//echo "<script>alert(".$_SESSION['orderid'].");</script>";

$sql = "SELECT * from order_placed WHERE id = ".$id." AND oid=".$_SESSION['orderid'].";";
$result = $conn->query($sql);

$sql2 = "SELECT * from user_details WHERE id =".$id."";
$result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
            while($row = $result2->fetch_assoc()) {
                
                $name       = $row["name"];
                $email      = $row["email"];
                $address    = $row["address"];
                $city       = $row["city"];
                $district   = $row["district"];
                $postal     = $row["postal"];
                $country    = $row["country"];
                $phoneno    = $row["phoneno"];
                
            }
    }   
    if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $oid = $row["oid"];
                $date = $row["date"];
                $total = $total + ($row["cost"]*$row["qty"]);
            }
    }
$result = $conn->query($sql);
                            
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
</head>

<body>

	<!--================Header Menu Area =================-->
	<header class="header_area">
		<div class="top_menu row m0">
			<div class="container-fluid">
				<div class="float-left">
					<p>Call Us: 012 44 5698 7456 896  
                    <?php 
                        if(isset($_SESSION["email"])){
                                echo "&nbsp&nbsp&nbspWelcome ".$_SESSION["name"]." !</p>";        
                            }else{
                            echo "</p>";
                        }
                        
                    ?>
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

	<!--================Order Details Area =================-->
	<section class="order_details p_120">
		<div class="container">
			<center><h3 style="float:center;">Order Confirmation.</h3></center>
			
            <h3 class="title_confirmation">Thank you. Your order has been received.</h3>
			<div class="row order_d_inner">
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Order Info</h4>
						
                        <ul class="list">
							<li>
								<a href="#">
									<span>Order number</span> : <?php echo $oid; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Date</span> : <?php echo $date; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Total</span> : INR <?php echo $total; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Payment method</span> : PAYPAL</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Billing Address</h4>
						<ul class="list">
							<li>
								<a href="#">
									<span>Street</span> : <?php echo $address; ?></a>
							</li>
							<li>
								<a href="#">
									<span>City</span> : <?php echo $city; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Country</span> : <?php echo $country; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Postcode </span> : <?php echo $postal; ?></a>
							</li>
                            <li>
								<a href="#">
									<span>Contact No </span> : <?php echo $phoneno; ?></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="details_item">
						<h4>Shipping Address</h4>
						<ul class="list">
							<li>
								<a href="#">
									<span>Street</span> : <?php echo $address; ?></a>
							</li>
							<li>
								<a href="#">
									<span>City</span> : <?php echo $city; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Country</span> : <?php echo $country; ?></a>
							</li>
							<li>
								<a href="#">
									<span>Postcode </span> : <?php echo $postal; ?></a>
							</li>
                            <li>
								<a href="#">
									<span>Contact No </span> : <?php echo $phoneno; ?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="order_details_table">
				<h2>Order Details</h2>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
                        
						<tbody>
							<?php
                            if ($result->num_rows > 0) {
                                // output data of each row
                                
                                while($row = $result->fetch_assoc()) {
                                
                            ?>
                            <tr>
								<td>
									<p><?php echo $row["name"]; ?></p>
								</td>
								<td>
									<h5>x <?php echo $row["qty"]; ?></h5>
								</td>
								<td>
									<p>₹<?php echo ($row["cost"]*$row["qty"]) ?>.00</p>
								</td>
							</tr>
                            
                            <!--
							<tr>
								<td>
									<p>Pixelstore fresh Blackberry</p>
								</td>
								<td>
									<h5>x 02</h5>
								</td>
								<td>
									<p>$720.00</p>
								</td>
							</tr>
                            
							<tr>
								<td>
									<p>Pixelstore fresh Blackberry</p>
								</td>
								<td>
									<h5>x 02</h5>
								</td>
								<td>
									<p>$720.00</p>
								</td>
							</tr>-->
                            <?php
                                }
                            }
                            
                            ?>
                            
							
                            <tr>
								<td>
									<h4>Subtotal</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>₹<?php echo $total ?>.00</p>
								</td>
							</tr>
                            
                            
							<tr>
								<td>
									<h4>Shipping</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>Flat rate: ₹50.00</p>
								</td>
							</tr>
							<tr>
								<td>
									<h4>Total</h4>
								</td>
								<td>
									<h5></h5>
								</td>
								<td>
									<p>₹<?php echo $total+50 ?>.00</p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--================End Order Details Area =================-->

	<!--================ Subscription Area ================-->
	<section class="subscription-area section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title text-center">
						<h2>Subscribe for Our Newsletter</h2>
						<span>We won’t send any kind of spam</span>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div id="mc_embed_signup">
						<form target="_blank" novalidate action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01"
						 method="get" class="subscription relative">
							<input type="email" name="EMAIL" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"
							 required="">
							<!-- <div style="position: absolute; left: -5000px;">
									<input type="text" name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="">
								</div> -->
							<button type="submit" class="newsl-btn">Get Started</button>
							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Subscription Area ================-->

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
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