<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	// Load all movies from the database
	if(isset($_GET["complex"])) {
		$query = $db->prepare("SELECT title, thumbnail FROM `movie` JOIN `showing` ON movieTitle=title WHERE complexName=?");
		$query->execute([$_GET["complex"]]);
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	} else {
		$query = $db->prepare("SELECT title, thumbnail FROM `movie`");
		$query->execute();
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	}

	$query = $db->prepare("SELECT name FROM `complex`");
	$query->execute();
	$complexes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
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
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="showtimes.php" class="s-header-v2__nav-link">Showtimes</a></li>
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
		<div style="padding-top: 1rem;"class="s-promo-v1">
		<h3 style="font-family: Montserrat, sans-serif;">Filter by complex:</h3>
		<div class="selectComplex">
			<a href="showtimes.php"style="font-family: Montserrat, sans-serif;">No filter</a><br>
<?PHP
	foreach($complexes as $complex) {
?>
			<a href="showtimes.php?complex=<?PHP echo(htmlspecialchars(urlencode($complex["name"]))); ?>">
				<?PHP echo(htmlspecialchars($complex["name"])); ?>
			</a><br>
<?PHP
	}
?>
		</div>
		<br>
		<h3 style="font-family: Montserrat, sans-serif;">View movie showtimes:</h3>
		<div class="selectMovie">
<?PHP
	foreach($movies as $movie) {
?>
			<a href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($movie["title"]))); ?>">
				<div class="movieThumbnail">
					<img src="<?PHP echo(htmlspecialchars($movie["thumbnail"])); ?>"></img>
				</div>
				<div class="movieTitle">
					<?PHP echo(htmlspecialchars($movie["title"])); ?>
				</div>
			</a>
			<br>
<?PHP
	}
?>
		</div>
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
