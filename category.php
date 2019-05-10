<!doctype html>
<html lang="en">
<?php 
    session_start(); 
    require 'phpfiles/init.php';
    include_once 'phpfiles/Pagination.php';

    

    //redirection 
    $full_path = pathinfo($_SERVER['PHP_SELF']);
    $current_filename = $full_path['basename'];
    
    $url = $_SERVER['REQUEST_URI'];
    $id = substr($url, strrpos($url, '/') + 1);
    
    $baseURL = 'http://localhost'.$full_path['dirname'].'/'.$id;
    
    $_SESSION["redirectionflag"] = $id;
    
    if(isset($_GET['search_query'])){
        $search_query  = $_GET['search_query'];
    }else{
        $search_query  = '';
    }
    
    
    //echo $baseURL;
    
    //return;
    
    //$baseURL = 'http://localhost'.$full_path['dirname'].'/'.$current_filename.'';
    $limit = 12;

    // Paging limit & offset
    $offset = !empty($_GET['page'])?(($_GET['page']-1)*$limit):0;

    
    // Count of all records
    if($search_query == ''){
            $query = $conn->query("SELECT COUNT(*) as rowNum FROM product_details");
    }else{
            $query = $conn->query("SELECT COUNT(*) as rowNum FROM product_details WHERE name LIKE '%$search_query%';");
    }    

    //$query   = $conn->query("SELECT COUNT(*) as rowNum FROM product_details");
    $result  = $query->fetch_assoc();
    $rowCount= $result['rowNum'];

    // Initialize pagination class
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows'=>$rowCount,
        'perPage'=>$limit
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit
        if($search_query == ''){
            $query = $conn->query("SELECT * FROM product_details ORDER BY pid ASC LIMIT $offset,$limit");
        }else{
            $query = $conn->query("SELECT * FROM product_details WHERE name LIKE '%$search_query%';");
        }
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
    
    <!--================Category Product Area =================-->
	<section class="cat_product_area section_gap">
		
        <div class="container-fluid">
            
            <!--Searching Product-->
            <div class="row justify-content-center" style="margin-top:1%;margin-bottom:1%;">
                        <div class="col-lg-6">
                            <div id="mc_embed_signup">
                                <form novalidate action="category.php?search=" name="my_search" id="my_search" method="gxet" class="subscription relative">
                                    <input type="text" name="search_query" id="search_query" placeholder="Enter product name..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter product name...'" 
                                     required="" >
                                    <button type="submit" class="newsl-btn" onclick="document.getElementById('my_search').submit();">Search</button>

                                </form>
                            </div>
                        </div>
            </div>
            <!--Searching Product End-->
            
			<div class="row flex-row-reverse">
				
                <div class="col-lg-9">
                    
                    <!--UPPER Product Filter options-->
					<div class="product_top_bar">
						
						<div class="right_page ml-auto">
				
                            <nav class="cat_page mx-auto" aria-label="Page navigation example">
					
                                <?php echo $pagination->createLinks(); ?>
                   
                            </nav>
						</div>
					</div>
                    <!--UPPER Product Filter options END-->
                    
                    
                    <!-- Display products-->
					<div class="latest_product_inner row">
						
                        <?php
                    /*
                    $sql = "SELECT pid,name,cost,img FROM product_details ORDER BY pid asc LIMIT ".$offset.",".$limit."";
                        
                    $result = $conn->query($sql);
                    
                        */
                    if ($query->num_rows > 0) {
                        // output data of each row
                        $i=1;
                        while($row = $query->fetch_assoc()) {
                    ?>    

                    <div class="col-lg-3 col-md-3 col-sm-6">
						<div class="f_p_item">
							<div class="f_p_img">
								<img class="img-fluid" src="img/product/set_01/<?php echo $row["img"]?>" alt="">
								
                                <!--<form action="single-product.php" method="get" id="my_form<?php echo $i ?>">
                                
                                    <input type="hidden" id="pid" name="pid" value="<?php echo $row["pid"] ?>">-->
                                    
                                <div class="p_icon" style="display:inline-flex;">
                                    
                                
                                <form action="phpfiles/addtowishlist.php" method="get" id="my_form1<?php echo $i ?>">
                                
                                    <input type="hidden" id="pid" name="pid" value="<?php echo $row["pid"] ?>">
                                    
                                    <a  href="javascript:{}" onclick="document.getElementById('my_form1<?php echo $i ?>').submit();" >
										<i class="lnr lnr-heart"></i>
									</a >&nbsp;&nbsp;
                                
                                </form>
                                
                                <form action="single-product.php" method="get" id="my_form<?php echo $i ?>">
                                
                                    <input type="hidden" id="pid" name="pid" value="<?php echo $row["pid"] ?>">
                            
                                    <a href="javascript:{}" onclick="document.getElementById('my_form<?php echo $i ?>').submit();">
										<i class="lnr lnr-cart"></i>
									</a>
                                
                                </form>
                                </div>
                                </div>
							<a href="#">
								<h4><?php echo $row["name"] ?></h4>
							</a> 
							<h5>₹ <?php echo $row["cost"] ?>.00</h5>
						</div>
					</div>
                    
                    <?php
                            
                            $i++;
                        }
                        
                    }else {
                    ?>
                    <div class="col-lg-12 col-md-3 col-sm-6">
                    <center><h1>No results !</h1></center>
                    </div>    
                    
                    <?php
                    
                    }
                    
                    ?> 
                        
					    
					</div>
                    <!-- Display products ENd-->
					
				</div>
				<!-- LEFT PRODUCT FILTER-->
                <div class="col-lg-3">
					<div class="left_sidebar_area">
					
						<aside class="left_widgets p_filter_widgets">
							<div class="l_w_title">
								<h3>Product Filters</h3>
							</div>
							<div class="widgets_inner">
								<h4>Company</h4>
								<ul class="list">
								    
                                    <li id="i8">
										<a href="#" onclick="document.getElementById('search_query').value='natural';
                                                        document.getElementById('my_search').submit();
                                                             ">Natural</a>
									</li>
                                    <li id="i8">
										<a href="#" onclick="document.getElementById('search_query').value='vaseline';
                                                        document.getElementById('my_search').submit();
                                                             ">Vaseline</a>
									</li>
                                    <li id="i8">
										<a href="#" onclick="document.getElementById('search_query').value='vega';
                                                        document.getElementById('my_search').submit();
                                                             ">Vega</a>
									</li>
                                    <li id="i8">
										<a href="#" onclick="document.getElementById('search_query').value='lakme';
                                                        document.getElementById('my_search').submit();
                                                             ">Lakme</a>
									</li>
                                    
                                </ul>
							</div>
							
                            <div class="widgets_inner">
								<h4>COLOUR</h4>
								<ul class="list">
									<li id="i2">
										<a href="#" onclick="document.getElementById('search_query').value='blue';
                                                        document.getElementById('my_search').submit();
                                                        ">Blue</a>
									</li>
									<li id="i3">
										<a href="#" onclick="document.getElementById('search_query').value='green';
                                                        document.getElementById('my_search').submit();
                                                        ">Green</a>
									</li>
									<li id="i4">
										<a href="#" onclick="document.getElementById('search_query').value='black';
                                                        document.getElementById('my_search').submit();
                                                        ">Black</a>
									</li>
									<li id="i5">
										<a href="#" onclick="document.getElementById('search_query').value='red';
                                                        document.getElementById('my_search').submit();
                                                        ">Red</a>
									</li >
									<li id="i6" class="">
										<a href="#" onclick="document.getElementById('search_query').value='pink';
                                                        document.getElementById('my_search').submit();
                                                        ">Pink</a>
									</li>
									<li id="i7">
										<a href="#" onclick="document.getElementById('search_query').value='white';
                                                        document.getElementById('my_search').submit();
                                                        ">White</a>
									</li>
									<li id="i8">
										<a href="#" onclick="document.getElementById('search_query').value='yellow';
                                                        document.getElementById('my_search').submit();
                                                             ">Yellow</a>
									</li>
								</ul>
							</div>
							
						</aside>
					</div>
				</div>
			     <!-- LEFT PRODUCT FILTER END-->
                
            </div>

            <div class="row" style="margin-top:5%;">
               <nav class="cat_page mx-auto" aria-label="Page navigation example">
				       <?php echo $pagination->createLinks(); ?>
               </nav>
            </div>
		</div>
	</section>
	<!--================End Category Product Area =================-->

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