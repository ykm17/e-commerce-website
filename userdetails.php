<!doctype html>
<html lang="en">
<?php
    
session_start();
require 'phpfiles/init.php';
$id = $_SESSION["id"];
    
$full_path = pathinfo($_SERVER['PHP_SELF']);
$current_filename = $full_path['basename'];
$_SESSION["redirectionflag"] = $current_filename;

$sql = "SELECT user_cart.kid , user_cart.id , user_cart.pid , product_details.name ,product_details.description, product_details.type , product_details.availability , product_details.cost, user_cart.date , user_cart.quantity FROM product_details INNER JOIN user_cart ON user_cart.pid = product_details.pid WHERE id = ".$id."";

$result = $conn->query($sql);

$sql2 = "SELECT * FROM user_details WHERE id =".$id."";

$result2 = $conn->query($sql2);
    
    if ($result2->num_rows > 0) {
                                // output data of each row
        $i=0;
        $total = 0;
        while($row = $result2->fetch_assoc()){
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

    $total =0;  
    

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

	<br>
	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap">
		<div class="container">
			
            
            
			<div class="billing_details">
				<div class="row">
					
					<div class="col-lg-4">
						<div class="order_box">
                            <div class="d-flex">
											<img src="img/product/single-product/review-1.png" alt="">
				            </div>
							<h2 style="margin-top:5%;"><?php echo $name?></h2>
							
							<ul class="list list_2">
								<li>
									<a href="#">
										BBC ID: <?php echo $id ?>-BBC   
									</a>
								</li>
								<li>
									<a href="#"><?php echo $email  ?>
										
									</a>
								</li>
							</ul>
							
                            
                            <button class="main_btn" type="submit" href="javascript:{}" onclick="validate();">Update Details</button>
						  
                        </div>
					</div>
				    <div class="col-lg-8">
						<h3>Billing Details</h3>
						<form class="row contact_form" action="phpfiles/updateuserdetails.php" method="post" id="my_array_form" validate>
							<div class="col-md-6 form-group p_star">
								<input type="text" class="form-control" id="name" name="name" placeholder="Full name" value="<?php echo $name ?>" required>
								<span class="placeholder" placeholder="Full name"></span>
							</div>
							<div class="col-md-6 form-group p_star">
								<input type="number" class="form-control" id="phoneno" name="phoneno" maxlength="10" placeholder="Phone number" value="<?php if($phoneno!=0)echo $phoneno; ?>" required>
								<span class="placeholder" ></span>
							</div>
							<div class="col-md-12 form-group p_star">
								<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="<?php echo $email ?>" required="required">
								<span class="placeholder" ></span>
							</div>
                            <div class="col-md-12 form-group p_star">
								<input type="text" class="form-control" id="country" name="country" placeholder="Country" value="<?php echo $country ?>" required>
								<span class="placeholder" ></span>
							</div>
							
							<div class="col-md-12 form-group p_star">
								<input type="text" class="form-control" id="address" name="address" placeholder="Address line" value="<?php echo $address ?>" required>
								<span class="placeholder" ></span>
							</div>
							<div class="col-md-12 form-group p_star">
								<input type="text" class="form-control" id="city" name="city" placeholder="Town/City" value="<?php echo $city ?>" required>
								<span class="placeholder" ></span>
							</div>
                            <div class="col-md-12 form-group p_star">
								<input type="text" class="form-control" id="district" name="district" placeholder="District" value="<?php echo $district ?>" required>
								<span class="placeholder" ></span>
							</div>
							<div class="col-md-12 form-group p_star">
								<input type="number" class="form-control" id="postal" name="postal" maxlength="12" placeholder="Postcode/ZIP" value="<?php if($postal!=0)echo $postal; ?>" required>
							</div>
                            
                                            
						</form>
					</div>
                </div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->

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
        
        
        function validate() {
            var name = document.getElementById('name').value.trim();
            var email   = document.getElementById('email').value.trim();
            var address = document.getElementById('address').value.trim();
            var city    = document.getElementById('city').value.trim();
            var district= document.getElementById('district').value.trim();
            var postal  = document.getElementById('postal').value.trim();
            var country = document.getElementById('country').value.trim();
            var phoneno = document.getElementById('phoneno').value.trim();
            
        
            if(name=="" | email=="" | address==""| city=="" | district==""| postal=="" | country=="" | phoneno==""){
                alert("Some fields are empty !");
            }
            else{
                document.getElementById('my_array_form').submit();
            }   
               
        }
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