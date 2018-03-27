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
    <head style="color:red;background:black;">
		<!-- Basic -->
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Documentation</title>
		<meta name="keywords" content="HTML5 Theme"/>
		<meta name="description" content="Megakit - HTML5 Theme">
		<meta name="author" content="keenthemes.com">

		<!-- Web Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">

		<!-- Vendor Styles -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="vendor/themify/themify.css" rel="stylesheet" type="text/css"/>
		<link href="vendor/scrollbar/scrollbar.min.css" rel="stylesheet" type="text/css"/>
		<link href="vendor/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css"/>

		<!-- Theme Styles -->
		<link href="css/style.css" rel="stylesheet" type="text/css"/>
		<link href="css/global/global.css" rel="stylesheet" type="text/css"/>
		</head>

	<body>
		<header style="background:grey;" class="navbar-fixed-top s-header-v2 js__header-sticky">
				<!-- Navbar -->
				<nav class="s-header-v2__navbar">
						<div class="container g-display-table--lg">
								<!-- Navbar Row -->
								<div class="s-header-v2__navbar-row">
										<!-- Brand and toggle get grouped for better mobile display -->
										<div class="s-header-v2__navbar-col">
												<button type="button" class="collapsed s-header-v2__toggle" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
														<span class="s-header-v2__toggle-icon-bar"></span>
												</button>
										</div>

										<div class="s-header-v2__navbar-col s-header-v2__navbar-col-width--180">
												<!-- Logo -->
												<div class="s-header__logo">
														<a href="landingPage.html" class="s-header__logo-link">
															<img src="logo.png" style="height:250px;width:250px;">
														</a>
												</div>
												<!-- End Logo -->
										</div>

										<div class="s-header-v2__navbar-col s-header-v2__navbar-col--right">
												<!-- Collect the nav links, forms, and other content for toggling -->
												<div class="collapse navbar-collapse s-header-v2__navbar-collapse" id="nav-collapse">
														<ul class="s-header-v2__nav">
																<!-- Home -->
																<!-- edit urls -->
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="landingPage.html" class="s-header-v2__nav-link">Movies</a></li>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="landingPage.html" class="s-header-v2__nav-link">Showtimes</a></li>
																<!-- End Home -->
<?PHP
if(!isset($_SESSION["acctNumber"])) {
?>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signIn.php" class="s-header-v2__nav-link -is-active">Sign In</a></li>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signUp.php" class="s-header-v2__nav-link -is-active">Sign Up</a></li>
<?PHP
} else {
?>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signIn.php" class="s-header-v2__nav-link -is-active">Account</a></li>
<?PHP
}
?>
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
		<a href="signIn.php">Sign In</a>
		<a href="signUp.php">Sign Up</a>
<?PHP
	foreach($movies as $movie) {
?>
		<br>
		<a class="movieListing" href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($movie["title"]))); ?>">
			<?PHP echo(htmlspecialchars($movie["title"])); ?>
		</a>
<?PHP
	}
?>


	</body>
</html>
