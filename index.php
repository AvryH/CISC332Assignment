<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	// Load all movies from the database
	$query = $db->prepare("SELECT title FROM `movie`");
	$query->execute();
	$movies = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html lang="en" class="no-js">
    <!-- Begin Head -->

		<link href="styling.css" rel="stylesheet" type="text/css"/>
		<link href="css/global/global.css" rel="stylesheet" type="text/css"/>
		</head>

	<body>
		<header style="background:grey;">
				<!-- Navbar -->
				<nav >
						<div>
								<!-- Navbar Row -->
								<div class="s-header-v2__navbar-row">
										<!-- Brand and toggle get grouped for better mobile display -->
										<div class="s-header-v2__navbar-col">
												<!-- Logo -->
												<div>
														<a href="index.php">
															<img src="logo.png" style="height:200px;width:200px;">
														</a>
												</div>
												<!-- End Logo -->
										</div>

										<div>
												<!-- Collect the nav links, forms, and other content for toggling -->
												<div >
														<ul class="s-header-v2__nav s-header-v2__nav_icons">
																<!-- Home -->
																<!edit urls>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signIn.php" class="s-header-v2__nav-link">Sign In</a></li>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signUp.php" class="s-header-v2__nav-link">Sign Up</a></li>
																<li style="padding-top: 150px; " class="s-header-v2__nav-item"><a href="file:///C:/Users/sesin/Documents/GitHub/CISC332Assignment/landingPage.html" class="s-header-v2__nav-link">Movies</a></li>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="file:///C:/Users/sesin/Documents/GitHub/CISC332Assignment/landingPage.html" class="s-header-v2__nav-link">Showtimes</a></li>
																<!-- End Home -->
																</ul>
												</div>
												<!-- End Nav Menu -->
										</div>
								</div>
								<!-- End Navbar Row -->
						</div>
				</nav>
				<!-- End Navbar -->
		</header>
		<div class="s-promo-v1" >

<?PHP
	foreach($movies as $movie) {
?>
		<br style="">
		<a class="movieListing" href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($movie["title"]))); ?>">
			<?PHP echo(htmlspecialchars($movie["title"])); ?>
		</a>
<?PHP
	}
?>
</div>
<footer class="g-bg-color--dark">
		<!-- Links -->
		<div class="g-hor-divider__dashed--white-opacity-lightest">
				<div class="container g-padding-y-80--xs">
						<div class="row">
								<div class="col-sm-4 g-margin-b-20--xs g-margin-b-0--md">
										<ul class="list-unstyled g-ul-li-tb-5--xs g-margin-b-0--xs">
												<li><a class="g-font-size-15--xs g-color--white-opacity"><u>Contact Us</u></a></li>
												<li><a class="g-font-size-15--xs g-color--white-opacity">support@royaltheatres.com</a></li>
												<li><a class="g-font-size-15--xs g-color--white-opacity">+1 800-100-0101</a></li>
										</ul>
								</div>
						</div>
				</div>
		</div>
</footer>
	</body>
</html>
