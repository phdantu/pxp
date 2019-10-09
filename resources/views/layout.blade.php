<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Game Warrior Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="Game Warrior Template">
	<meta name="keywords" content="warrior, game, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/animate.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
			<div class="loader"></div>
		</div>
	
		<!-- Header section -->
		<header class="header-section">
			<div class="container">
				<!-- logo -->
				<a class="site-logo" href="index.html">
					<img src="img/PXPlogo.png" alt="Site Logo">
				</a>
				<div class="user-panel">
					<a href="#">Login</a>  /  <a href="#">Register</a>
				</div>
				<!-- responsive -->
				<div class="nav-switch">
					<i class="fa fa-bars"></i>
				</div>
				<!-- site menu -->
				<nav class="main-menu">
					<ul>
						<li><a href="/">Home</a></li>
						<li><a href="guias">Guias</a></li>
						<li><a href="categories.html">Blog</a></li>
						<li><a href="community.html">Forums</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<!-- Header section end -->
	@yield('content')


        <!-- Footer top section -->
        <section class="footer-top-section">
				<div class="container">
					<div class="footer-top-bg">
						<img src="img/footer-top-bg.png" alt="">
					</div>
					<div class="row">
						<div class="col-lg-4">
							<div class="footer-logo text-white">
								<img src="img/footer-logo.png" alt="">
								<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum dolor sit ame.</p>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="footer-widget mb-5 mb-md-0">
								<h4 class="fw-title">Latest Posts</h4>
								<div class="latest-blog">
									<div class="lb-item">
										<div class="lb-thumb set-bg" data-setbg="img/latest-blog/1.jpg"></div>
										<div class="lb-content">
											<div class="lb-date">June 21, 2018</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum </p>
											<a href="#" class="lb-author">By Admin</a>
										</div>
									</div>
									<div class="lb-item">
										<div class="lb-thumb set-bg" data-setbg="img/latest-blog/2.jpg"></div>
										<div class="lb-content">
											<div class="lb-date">June 21, 2018</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum </p>
											<a href="#" class="lb-author">By Admin</a>
										</div>
									</div>
									<div class="lb-item">
										<div class="lb-thumb set-bg" data-setbg="img/latest-blog/3.jpg"></div>
										<div class="lb-content">
											<div class="lb-date">June 21, 2018</div>
											<p>Lorem ipsum dolor sit amet, consectetur adipisc ing ipsum </p>
											<a href="#" class="lb-author">By Admin</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="footer-widget">
								<h4 class="fw-title">Top Comments</h4>
								<div class="top-comment">
									<div class="tc-item">
										<div class="tc-thumb set-bg" data-setbg="img/authors/1.jpg"></div>
										<div class="tc-content">
											<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
											<div class="tc-date">June 21, 2018</div>
										</div>
									</div>
									<div class="tc-item">
										<div class="tc-thumb set-bg" data-setbg="img/authors/2.jpg"></div>
										<div class="tc-content">
											<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
											<div class="tc-date">June 21, 2018</div>
										</div>
									</div>
									<div class="tc-item">
										<div class="tc-thumb set-bg" data-setbg="img/authors/3.jpg"></div>
										<div class="tc-content">
											<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
											<div class="tc-date">June 21, 2018</div>
										</div>
									</div>
									<div class="tc-item">
										<div class="tc-thumb set-bg" data-setbg="img/authors/4.jpg"></div>
										<div class="tc-content">
											<p><a href="#">James Smith</a> <span>on</span>  Lorem ipsum dolor sit amet, co</p>
											<div class="tc-date">June 21, 2018</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Footer top section end -->
		
			
			<!-- Footer section -->
			<footer class="footer-section">
				<div class="container">
					<ul class="footer-menu">
						<li><a href="index.html">Home</a></li>
						<li><a href="review.html">Games</a></li>
						<li><a href="categories.html">Blog</a></li>
						<li><a href="community.html">Forums</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
					<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
		<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		</p>
				</div>
			</footer>
			<!-- Footer section end -->
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.marquee.min.js"></script>
	<script src="js/main.js"></script>
    </body>
</html>