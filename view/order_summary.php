<?php
// Include your general class file
session_start();
include("../controllers/general_controller.php");

// Check if user is authenticated
if(isset($_SESSION['user_id'])) {
    // User is authenticated, retrieve user_id from session
    $user_id = $_SESSION['user_id'];


    // Fetch products data that are in the user's cart
    $products_in_cart = getProductsInCart_ctr($user_id);

    // Calculate subtotal
    $subtotal = 0;
    foreach ($products_in_cart as $product) {
        $subtotal += $product['product_price'] * $product['qty']; // Multiply price by quantity
    }

    // Calculate shipping cost based on the number of items in the cart and their prices
    $shipping = 0;
    if ($subtotal > 0 && $subtotal <= 100) {
        $shipping = 10; // Example shipping cost for subtotal between 1 and 100
    } elseif ($subtotal > 100 && $subtotal <= 200) {
        $shipping = 15; // Example shipping cost for subtotal between 101 and 200
    } else {
        $shipping = 20; // Example shipping cost for subtotal above 200
    }

    // Calculate total
    $total = $subtotal + $shipping;

} else {
    // User is not authenticated, redirect to login page or display a message
    header("Location: login.php");
    exit; // Stop
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">
    <title>Order Summary</title>
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- Add additional CSS files if necessary -->
</head>
<body>
    <!-- PreLoader -->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!-- PreLoader Ends -->

    
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="../index.php">
								<img src="../assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="../index.php">Home</a>
						
								</li>
								<li><a href="about.html">About</a></li>
								<li><a href="#">Pages</a>
									<ul class="sub-menu">
										<li><a href="404.html">404 page</a></li>
										<li><a href="about.html">About</a></li>
										<li><a href="cart.php">Cart</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="contact.html">Contact</a></li>
										<li><a href="news.html">News</a></li>
										<li><a href="shop.php">Shop</a></li>
									</ul>
								</li>
								<li><a href="news.html">News</a>
									<ul class="sub-menu">
										<li><a href="news.html">News</a></li>
										<li><a href="single-news.html">Single News</a></li>
									</ul>
								</li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="shop.php">Shop</a>
									<ul class="sub-menu">
										<li><a href="shop.php">Shop</a></li>
										<li><a href="checkout.php">Check Out</a></li>
										<li><a href="single-product.php">Single Product</a></li>
										<li><a href="cart.php">Cart</a></li>
									</ul>
								</li>
								<li>
								<div class="header-icons">
									<a class="shopping-cart" href="cart.php"><i class="fas fa-shopping-cart"></i></a>
									<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									<?php if(isset($_SESSION['user_id'])): ?>
										<!-- Logout Icon -->
										<a class="mobile-hide" href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
									<?php else: ?>
										<!-- Signup Icon -->
										<a class="mobile-hide" href="register.php"><i class="fas fa-user-plus"></i></a>
										<!-- Login Icon -->
										<a class="mobile-hide" href="login.php"><i class="fas fa-sign-in-alt"></i></a>
									<?php endif; ?>
								</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

    <!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search arewa -->

    <!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Fresh and Organic</p>
						<h1>View Order Summary</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

    <!-- summary section -->
<div class="checkout-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Order Summary -->
                <div class="order-summary">
                    <h2>Order Summary</h2>
                    <table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
                                <th class="product-name">Product</th>
								<th class="product-price">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through products in cart to display -->
                            <?php foreach ($products_in_cart as $product) : ?>
                                <tr class="table-body-row">
                                    <td class="product-name"><?php echo $product['product_title']; ?></td>
                                    <td class="product-price"><?php echo '$' . $product['product_price'] * $product['qty']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>Subtotal</td>
                                <td><?php echo '$' . $subtotal; ?></td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td><?php echo '$' . $shipping; ?></td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td id="amount"><?php echo '$' . $total; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Order Summary -->
            </div>
            
        </div>
    </div>
</div>
<!-- end summary section -->


    <!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="../assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="../assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="../assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="../assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="../assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->

    <!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@HairWorld.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="../index.php">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="services.html">Shop</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="../index.php">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

    <!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>,  All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

    <!-- jQuery -->
    <script src="../assets/js/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Count down -->
    <script src="../assets/js/jquery.countdown.js"></script>
    <!-- Isotope -->
    <script src="../assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- Waypoints -->
    <script src="../assets/js/waypoints.js"></script>
    <!-- Owl carousel -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <!-- Magnific popup -->
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Mean menu -->
    <script src="../assets/js/jquery.meanmenu.min.js"></script>
    <!-- Sticker js -->
    <script src="../assets/js/sticker.js"></script>
    <!-- Main js -->
    <script src="../assets/js/main.js"></script>
    <!-- Custom JavaScript -->
    <script src="../js/pay.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</body>
</html>