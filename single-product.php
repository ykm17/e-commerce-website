<!doctype html>
<html lang="en">
<?php 
    require 'phpfiles/init.php';
    session_start();
    
    if(isset($_SESSION["pid"]) && $_GET["pid"] == null){ 
        header("Location: index.php");
    }else if($_GET["pid"] <> null){
        $pid = $_GET["pid"];
    }
    else if($_SESSION["pid"] == null){
        $pid = $_GET["pid"];    
        $_SESSION["pid"] = $_GET["pid"];
    }else{
        $pid = $_SESSION["pid"];
    }
    
    
    $full_path = pathinfo($_SERVER['PHP_SELF']);
    $current_filename = $full_path['basename'];
    $_SESSION["redirectionflag"] = $current_filename;
    
    $sql = "SELECT * FROM product_details WHERE pid =".$pid.";";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $description = $row["description"];    
            $cost = $row["cost"];
            $type = $row["type"]; 
            $availability = $row["availability"];
            $img = $row["img"];
        }
    }
    
    $sql3 = "SELECT * FROM user_reviews WHERE pid=".$pid.";";
    $result3 = $conn->query($sql3);
    
    //echo "<script>alert(".($result3->num_rows+1).")</script>";

    $total_reviews = $result3->num_rows;
    
    $star1= 0;
    $star2= 0;
    $star3= 0;
    $star4= 0;
    $star5= 0;
    
    $star_total = 0;
    if ($result3->num_rows > 0) {
        // output data of each row
        while($row = $result3->fetch_assoc()) {
            if($row["rating_star"] == 1) $star1++;
            if($row["rating_star"] == 2) $star2++;
            if($row["rating_star"] == 3) $star3++;
            if($row["rating_star"] == 4) $star4++;
            if($row["rating_star"] == 5) $star5++;
            $star_total = $star_total + $row["rating_star"];
            
        }
    }
    //return;
    $avg = 0;
    if($total_reviews > 0)
    $avg = $star_total/$total_reviews;
    
    $avg = number_format($avg, 2);
    if($avg=="nan") $avg =0; 
    
    //return;
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
	<!--================End Home Banner Area =================-->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div class="s_product_img">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
									<img src="img/product/set_small_01/<?php echo $img ?>" alt="">
								</li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1">
									<img src="img/product/set_small_02/<?php echo $img ?>" alt="">
								</li>
							</ol>
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img style="height:470px;" class="d-block w-100" src="img/product/set_01/<?php echo $img ?>" alt="First slide">
								</div>
								<div class="carousel-item">
									<img style="height:470px;" class="d-block w-100" src="img/product/set_02/<?php echo $img ?>" alt="Second slide">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					
                    <form action="phpfiles/addtocart.php" method="get" id="my_form">
                                
                        <div class="s_product_text">
                            <h3><?php echo $name ?></h3>
                            <h2>₹ <?php echo $cost ?>.00</h2>
                            <ul class="list">
                                <li>
                                    <a class="active" href="#">
                                        <span>Category</span> : <?php echo $type ?></a>
                                </li>
                                <li>
                                    <a href="#">                <!--: In Stock-->    
                                        <span>Availibility</span> : <?php echo $availability ?> </a>
                                </li>
                            </ul>
                            <p><?php echo $description ?></p>
                            <div class="product_count">
                                <label for="qty">Quantity:</label>
                                <input type="text" name="quantity" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                
                                <input type="hidden" id="pid" name="pid" value="<?php echo $pid ?>">
                                
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                 class="increase items-count" type="button">
                                    <i class="lnr lnr-chevron-up"></i>
                                </button>
                                <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
                                 class="reduced items-count" type="button">
                                    <i class="lnr lnr-chevron-down"></i>
                                </button>
                            </div>
                            <div class="card_area">
                                <input type="hidden" id="redirectionflag" name="redirectionflag" value="index.php">
                                <a class="main_btn" href="javascript:{}" onclick="isUserLoggedInCart();">Add to Cart</a>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<!--<li class="nav-item">
					<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
				</li>
				--><li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
					<p><?php echo $description;echo $description; ?></p>
					<p><?php echo $description;echo $description; ?></p>
				</div>
				
                <!--<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td>
										<h5>Width</h5>
									</td>
									<td>
										<h5>128mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Height</h5>
									</td>
									<td>
										<h5>508mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Depth</h5>
									</td>
									<td>
										<h5>85mm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Weight</h5>
									</td>
									<td>
										<h5>52gm</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Quality checking</h5>
									</td>
									<td>
										<h5>yes</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Freshness Duration</h5>
									</td>
									<td>
										<h5>03days</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>When packeting</h5>
									</td>
									<td>
										<h5>Without touch of hand</h5>
									</td>
								</tr>
								<tr>
									<td>
										<h5>Each Box contains</h5>
									</td>
									<td>
										<h5>60pcs</h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="comment_list">
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/single-product/review-1.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2017 at 05:56 pm</h5>
											<a class="reply_btn" href="#">Reply</a>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
								<div class="review_item reply">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/single-product/review-2.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2017 at 05:56 pm</h5>
											<a class="reply_btn" href="#">Reply</a>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/single-product/review-3.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2017 at 05:56 pm</h5>
											<a class="reply_btn" href="#">Reply</a>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post a comment</h4>
								<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="btn submit_btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				-->
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="row total_rate">
								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4><?php echo $avg ?></h4>
										<h6>(<?php echo $total_reviews; ?> Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on <?php echo $total_reviews; ?> Reviews</h3>
										<ul class="list">
											<li>
												<a href="#">5 Star
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i> <?php echo $star5; ?></a>
											</li>
											<li>
												<a href="#">4 Star
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i> <?php echo $star4; ?></a>
											</li>
											<li>
												<a href="#">3 Star
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i> <?php echo $star3; ?></a>
											</li>
											<li>
												<a href="#">2 Star
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i> <?php echo $star2; ?></a>
											</li>
											<li>
												<a href="#">1 Star
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i> <?php echo $star1; ?></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="review_list">
                                
                                <?php 
                                    $sql3 = "SELECT * FROM user_reviews WHERE pid=".$pid.";";
                                    $result3 = $conn->query($sql3);

                                    if ($result3->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result3->fetch_assoc()) {

                                ?>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/single-product/review-1.png" alt="">
										</div>
										<div class="media-body">
											<h4><?php echo $row["user_name"]; ?></h4>
											<?php
                                                if($row["rating_star"]==5){
                                                    echo "
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    ";
                                                }
                                                if($row["rating_star"]==4){
                                                        echo "
                                                        <i class=\"fa fa-star\"></i>
                                                        <i class=\"fa fa-star\"></i>
                                                        <i class=\"fa fa-star\"></i>
                                                        <i class=\"fa fa-star\"></i>
                                                        <i class=\"fa fa-star-o\"></i>
                                                        ";
                                                }
                                                if($row["rating_star"]==3){
                                                    echo "
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    ";
                                                }
                                                if($row["rating_star"]==2){
                                                    echo "
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    ";
                                                }
                                                if($row["rating_star"]==1){
                                                    echo "
                                                    <i class=\"fa fa-star\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    <i class=\"fa fa-star-o\"></i>
                                                    ";
                                                }
                                                
                                            ?>
                                            <!--<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>-->
										</div>
									</div>
									<p><?php echo $row["review"];?></p>
								</div>
                                
                                <?php
                                        }
                                    }
                                ?>
                                    
								<!--<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/single-product/review-2.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/single-product/review-3.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
										aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
								</div>-->
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Add a Review</h4>
								<p>Your Rating:</p>
								<ul class="list">
									<li>
										<a href="javascript:{}" onmouseover="highlightstar(1,0);" onmouseout="highlightstar(1,1);" onclick="changestar(1);" value="1">
											<i class="fa fa-star-o" id="star1"></i>
										</a>
									</li>
									<li>
										<a href="javascript:{}" onmouseover="highlightstar(2,0);" onmouseout="highlightstar(2,1);" onclick="changestar(2);" value="2">
											<i class="fa fa-star-o" id="star2"></i>
										</a>
									</li>
									<li>
										<a href="javascript:{}" onmouseover="highlightstar(3,0);"
                                           onmouseout="highlightstar(3,1);" onclick="changestar(3);" value="3">
											<i class="fa fa-star-o" id="star3"></i>
										</a>
									</li>
									<li>
										<a href="javascript:{}" onmouseover="highlightstar(4,0);" onmouseout="highlightstar(4,1);" onclick="changestar(4);" value="4">
											<i class="fa fa-star-o" id="star4"></i>
										</a>
									</li>
									<li>
										<a href="javascript:{}" onmouseover="highlightstar(5,0);" onmouseout="highlightstar(5,1);" onclick="changestar(5);" value="5";>
											<i class="fa fa-star-o" id="star5"></i>
										</a>
									</li>
								</ul>
								<p>Outstanding</p>
								<form class="row contact_form" action="phpfiles/addreview.php" method="post" id="contactForm" >
									
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Review" required></textarea>
										</div>
									</div>
                                    <input type="hidden" name="rating_star" value="1" id="rating_star"> 
									<input type="hidden" name="pid" value="<?php echo $pid; ?>" id="pid"> 
									<input type="hidden" name="pname" value="<?php echo $name; ?>" id="pname"> 
									
                                    <div class="col-md-12 text-right">
										<a href="javascript:{}" value="submit" onclick="isUserLoggedInReview();" class="btn submit_btn">Submit Now</a>
                                        
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Product Description Area =================-->

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
        function isUserLoggedInCart(){
            var data = "<?php if(isset($_SESSION["id"]))echo true; else echo false; ?>";
            //alert(data);
            if(data==1){
                //user is logged in, go ahead
                document.getElementById('my_form').submit();
            }else{
                //prompt user to login
                alert("Please login to load your cart !");
                location.href='login.php';
                
            }
            
        }
        var selectiondone = -1;
        function highlightstar(no,flag){
            //alert(no);
            if(flag == 0){
                if(no==1){
                document.getElementById('star'+1).className = 'fa fa-star';
                document.getElementById('star'+2).className = 'fa fa-star-o';
                document.getElementById('star'+3).className = 'fa fa-star-o';
                document.getElementById('star'+4).className = 'fa fa-star-o';
                document.getElementById('star'+5).className = 'fa fa-star-o';
                    
            }
            else if(no==2){
                document.getElementById('star'+1).className = 'fa fa-star';
                document.getElementById('star'+2).className = 'fa fa-star';
                document.getElementById('star'+3).className = 'fa fa-star-o';
                document.getElementById('star'+4).className = 'fa fa-star-o';
                document.getElementById('star'+5).className = 'fa fa-star-o';
            }
            else if(no==3){
                document.getElementById('star'+1).className = 'fa fa-star';
                document.getElementById('star'+2).className = 'fa fa-star';
                document.getElementById('star'+3).className = 'fa fa-star';
                document.getElementById('star'+4).className = 'fa fa-star-o';
                document.getElementById('star'+5).className = 'fa fa-star-o';
            }
            else if(no==4){
                document.getElementById('star'+1).className = 'fa fa-star';
                document.getElementById('star'+2).className = 'fa fa-star';
                document.getElementById('star'+3).className = 'fa fa-star';
                document.getElementById('star'+4).className = 'fa fa-star';         
                document.getElementById('star'+5).className = 'fa fa-star-o';
            }
            else{
                document.getElementById('star'+1).className = 'fa fa-star';
                document.getElementById('star'+2).className = 'fa fa-star';
                document.getElementById('star'+3).className = 'fa fa-star';
                document.getElementById('star'+4).className = 'fa fa-star';
                document.getElementById('star'+5).className = 'fa fa-star';
                var a = document.getElementsByTagName("star5")[0].href;
                alert(a);
            }   
    
            }else{
                   if(selectiondone == -1){
                       
                    if(no==1){
                        document.getElementById('star'+1).className = 'fa fa-star-o';
                        
                    }
                    else if(no==2){
                        document.getElementById('star'+1).className = 'fa fa-star-o';
                        document.getElementById('star'+2).className = 'fa fa-star-o';
                        
                    }
                    else if(no==3){
                        document.getElementById('star'+1).className = 'fa fa-star-o';
                        document.getElementById('star'+2).className = 'fa fa-star-o';
                        document.getElementById('star'+3).className = 'fa fa-star-o';
                        
                    }
                    else if(no==4){
                        document.getElementById('star'+1).className = 'fa fa-star-o';
                        document.getElementById('star'+2).className = 'fa fa-star-o';
                        document.getElementById('star'+3).className = 'fa fa-star-o';
                        document.getElementById('star'+4).className = 'fa fa-star-o';
                        
                    }
                    else if(no==5){
                        document.getElementById('star'+1).className = 'fa fa-star-o';
                        document.getElementById('star'+2).className = 'fa fa-star-o';
                        document.getElementById('star'+3).className = 'fa fa-star-o';
                        document.getElementById('star'+4).className = 'fa fa-star-o';
                        document.getElementById('star'+5).className = 'fa fa-star-o';
                        
                    }
                   }else{
                     if(selectiondone==4){
                        document.getElementById('star'+5).className = 'fa fa-star-o';
                        
                    }
                    else if(selectiondone==3){
                        document.getElementById('star'+5).className = 'fa fa-star-o';
                        document.getElementById('star'+4).className = 'fa fa-star-o';
                        
                    }
                    else if(selectiondone==2){
                        document.getElementById('star'+5).className = 'fa fa-star-o';
                        document.getElementById('star'+4).className = 'fa fa-star-o';
                        document.getElementById('star'+3).className = 'fa fa-star-o';
                        
                    }
                    else if(selectiondone==1){
                        document.getElementById('star'+4).className = 'fa fa-star-o';
                        document.getElementById('star'+4).className = 'fa fa-star-o';
                        document.getElementById('star'+3).className = 'fa fa-star-o';
                        document.getElementById('star'+2).className = 'fa fa-star-o';
                        
                    }
                   }
               
            }
        }
        
               
        function changestar(no){

                 if(no==1){
                    document.getElementById('star'+1).className = 'fa fa-star-o';
                    selectiondone = 1;
                 }
                else if(no==2){
                    document.getElementById('star'+1).className = 'fa fa-star-o';
                    document.getElementById('star'+2).className = 'fa fa-star-o';
                    selectiondone = 2;
                }
                else if(no==3){
                    document.getElementById('star'+1).className = 'fa fa-star-o';
                    document.getElementById('star'+2).className = 'fa fa-star-o';
                    document.getElementById('star'+3).className = 'fa fa-star-o';
                    selectiondone = 3;
                }
                else if(no==4){
                    document.getElementById('star'+1).className = 'fa fa-star-o';
                    document.getElementById('star'+2).className = 'fa fa-star-o';
                    document.getElementById('star'+3).className = 'fa fa-star-o';
                    document.getElementById('star'+4).className = 'fa fa-star-o';
                    selectiondone = 4;
                }
                else{
                    document.getElementById('star'+1).className = 'fa fa-star-o';
                    document.getElementById('star'+2).className = 'fa fa-star-o';
                    document.getElementById('star'+3).className = 'fa fa-star-o';
                    document.getElementById('star'+4).className = 'fa fa-star-o';
                    document.getElementById('star'+5).className = 'fa fa-star-o';
                    selectiondone = 5;
                }
                document.getElementById("rating_star").value = selectiondone;
            }
    
        function isUserLoggedInReview(){
            var review = document.getElementById('message').value;
            
            if(review==''){
                return;
            }
            var data = "<?php if(isset($_SESSION["id"]))echo true; else echo false; ?>";
            //alert(data);
            if(data==1){
                //user is logged in, go ahead
                //location.href='.php';
                document.getElementById('contactForm').submit();
            }else{
                //prompt user to login
                
                alert("Please login to load your cart !");
                location.href='login.php';
                
            }
            return false;
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