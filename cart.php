<!doctype html>
<html lang="en">
<?php
session_start();
require 'phpfiles/init.php';
$id = $_SESSION["id"];

$full_path = pathinfo($_SERVER['PHP_SELF']);
    $current_filename = $full_path['basename'];
    $_SESSION["redirectionflag"] = $current_filename;    
    
    
$sql = "SELECT user_cart.kid , user_cart.id , user_cart.pid , product_details.name ,product_details.description, product_details.type , product_details.availability , product_details.cost , product_details.img , user_cart.date , user_cart.quantity FROM product_details INNER JOIN user_cart ON user_cart.pid = product_details.pid WHERE id = ".$id."";

$data = array();
$result = $conn->query($sql);
$total =0;    
//---        
    
?>    
    
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>ListAshop</title>
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
						          </li>
                                  ";        
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
	<!--================End Home Banner Area =================-->

	<!--================Cart Area =================-->
	<?php
        
    if ($result->num_rows > 0) {
    
    ?><br><br>
    <section class="cart_area">
		<div class="container">
			<div class="cart_inner">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Product</th>
								<th scope="col">Price</th>
								<th scope="col">Quantity</th>
								<th scope="col">Total</th>
                                <th scope="col"></th>
                                
							</tr>
						</thead>
						<tbody>
                            
                            <?php
                                // output data of each row
                                $i=0;
                                $total = 0;
                                while($row = $result->fetch_assoc()) {
                                    
                                    $data[$i] = $row["id"];
                                    $data[$i+1] = $row["pid"];
                                    $data[$i+2] = $row["name"];
                                    $data[$i+3] = $row["cost"];
                                    $data[$i+4] = $row["quantity"];
                                    //$data[$i+5] = $row["quantity"];
                                    
                                    $i = $i + 5;
                                    $total = $total + ($row["cost"]*$row["quantity"]);
                                    

                            ?>
                            
                                        
                                         
							<tr>
                            <input type="hidden" id="id<?php echo $i ?>" value="<?php echo $row["id"] ?>">
                            <input type="hidden" id="pid<?php echo $i ?>" value="<?php echo $row["pid"] ?>">
                            <input type="hidden" id="name<?php echo $i ?>" value="<?php echo $row["name"] ?>">
                            <input type="hidden" id="cost<?php echo $i ?>" value="<?php echo $row["cost"] ?>">
                            <input type="hidden" id="quantity<?php echo $i ?>" value="<?php echo $row["quantity"] ?>">
                                <input type="hidden" id="quantity1111>" value="<?php echo $total ?>">
								<td>
									<div class="media">
										<div class="d-flex">
											<img style="height:100px;" src="img/product/set_01/<?php echo $row["img"]; ?>" alt="">
										</div>
										<div class="media-body">
											<p><?php echo $row["name"]; ?></p>
										</div>
									</div>
								</td>
								<td>
                                    <h5>₹<?php echo $row["cost"]; ?>.00</h5>
								</td>
								<td>
									<div class="product_count">
										<input type="text" name="qty" id="sst<?php echo $i; ?>" maxlength="12" value="<?php echo $row["quantity"]; ?>" title="Quantity:" class="input-text qty">
                                        
                                        <input type="hidden" id="getbyid<?php echo $i ?>" value="<?php echo $i ?>">
                                        
                                        <button id="updateqty" onclick="var result = document.getElementById('sst<?php echo $i;?>'); var sst<?php echo $i;?> = result.value;if( !isNaN( sst<?php echo $i;?> )) result.value++;
                                        var cno = document.getElementById('getbyid<?php echo $i ?>');                updateqty(cno.value);                                
                                        return false;"
										 class="increase items-count" type="button">
											<i class="lnr lnr-chevron-up"></i>
										</button>
                                        
										<button onclick="var result = document.getElementById('sst<?php echo $i;?>'); var sst<?php echo $i;?> = result.value; if( !isNaN( sst<?php echo $i;?> ) &amp;&amp; sst<?php echo $i;?> > 1 ) result.value--;
                                        var cno = document.getElementById('getbyid<?php echo $i ?>');                updateqty(cno.value);
                                        return false;"
										 class="reduced items-count" type="button">
											<i class="lnr lnr-chevron-down"></i>
										</button>
									</div>
								</td>
								<td>
                                    <h5>₹<?php echo ($row["cost"]*$row["quantity"]); ?>.00</h5>
                                    
								</td>
                                <td>
                                 
                                <div class="button-group-area">
                                    
                                        <form action="phpfiles/removefromcart.php" method="get" id="myform_todelete">
                                            
                                            <input type="hidden" name="product_id" value="<?php echo $row["pid"]; ?>">
                                            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
                                            
                                            <a href="javascript:{}" onclick="document.getElementById('myform_todelete').submit();" class="genric-btn danger circle">delete</a>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                            
                            <?php
                                }
                                
        
                            ?>
                            
                        
                            
                            
							<tr>
								<td>

								</td>
								<td>

								</td>
								<td>
									<h5>Subtotal</h5>
								</td>
								<td>
									<h5>₹<?php echo $total ?>.00</h5>
								</td>
                                <td>

								</td>
							</tr>
							<tr class="shipping_area">
								<td>

								</td>
								<td>

								</td>
								<td>
									<h5>Shipping</h5>
								</td>
								<td>
				                    <h5>Flat Rate: ₹50.00</h5>
										
								</td>
                                <td>

								</td>
							</tr>
							<tr class="out_button_area">
								<td>

								</td>
								<td>

								</td>
                                <td>

								</td>
								<td>

								</td>
								<td>
									<div class="checkout_btn_inner">
                                        
										<a class="gray_btn" href="category.php">Continue Shopping</a>
										<a class="main_btn" href="checkout.php" >Proceed to checkout</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--================End Cart Area =================-->
    <?php
    }else{
        echo "<section class=\"banner_area\">
		<div class=\"banner_inner d-flex align-items-center\">
			<div class=\"container\">
				<div class=\"banner_content text-center\">
					<h2>Oops! Your cart is empty</h2>
					<div class=\"page_link\">
						<a href=\"index.php\" style=\"font-size:30px;\">Find some here !</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	";   
        
    }
    
    
    ?>
    
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

        
  /*          $(document).ready(function(){
                $("#updateqty").click(function(){
                    alert(this.id);
                });
                });
*/

        function updateqty(cno){

                    var id = $("#id"+cno+"").val();    
                    var pid = $("#pid"+cno+"").val();    

                    var name = $("#name"+cno+"").val();
                    var cost = $("#cost"+cno+"").val();
                    var quantity = $("#sst"+cno+"").val();
                    
                    // Returns successful data submission message when the entered information is stored in database.
                    var dataString = 'name='+ name + '&cost='+ cost + '&quantity='+ quantity + '&pid='+ pid+ '&id='+ id;
                    //alert(dataString);
                    $.ajax({
                        type: "GET",
                        url: "phpfiles/updatecart.php",
                        data: dataString,
                        cache: false,
                        success: function(result){
                        //alert(result);
                        location.href='cart.php';
                        //reload page    
                    }
                    });
                    return false;
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