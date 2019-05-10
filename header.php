<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.php">
						<img src="img/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					 aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<div class="row w-100">
							<div class="col-lg-7 pr-0">
								<ul class="nav navbar-nav center_nav pull-right">
									<li class="nav-item active">
										<a class="nav-link" href="index.php">Home</a>
									</li>
									
                                    
                                    <li class="nav-item submenu dropdown">
										<a href="tracking.php" class="nav-link dropdown-toggle" >Tracking</a>
										
									</li>
                                    
                                    
									<li class="nav-item">
										<a class="nav-link" href="contact.php">Contact</a>
									</li>
                                    
                                    <?php if(isset($_SESSION["email"])==false){ ?>
                        
					    			<li class="nav-item submenu dropdown">
										<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More</a>
										<ul class="dropdown-menu">
											<li class="nav-item">
												<a class="nav-link" href="login.php">Login</a>
                                            </li>
                                            
											<li class="nav-item">
                                                <a class="nav-link" href="registration.php">Register</a>
                                            </li>
										</ul>
									</li>
                                    
                                    <?php }else{ ?>
						            <li class="nav-item">
										<a class="nav-link" href="javascript:{}"
                                           onclick="isUserLoggedInPast();">Past Orders</a>
									</li>
                                    
                                    
                                    <?php } ?>
								</ul>
							</div>

							<div class="col-lg-5">
								<ul class="nav navbar-nav navbar-right right_nav pull-right">
									<hr>
									<li class="nav-item">
										<a href="category.php" class="icons">
											<i class="fa fa-search" aria-hidden="true"></i>
										</a>
									</li>

									<hr>

									<li class="nav-item">
										<a href="javascript:{}"
                                           onclick="isUserLoggedIn2();" class="icons">
											<i class="fa fa-user" aria-hidden="true"></i>
										</a>
									</li>
                                    

									<hr>

									<li class="nav-item">
										<a href="wish-list.php" class="icons">
											<i class="fa fa-heart-o" aria-hidden="true"></i>
										</a>
									</li>

									<hr>

									<li class="nav-item">
										<a class="icons" href="javascript:{}"
                                           onclick="isUserLoggedIn();">
											<i class="lnr lnr lnr-cart"></i>
										</a>
									</li>

									<hr>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>
		</div>