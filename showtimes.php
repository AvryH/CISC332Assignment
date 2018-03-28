<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	// Load all movies from the database
	if(isset($_GET["complex"])) {
		$query = $db->prepare("SELECT title, thumbnail, showingID, startTime FROM `movie` JOIN `showing` ON movieTitle=title WHERE complexName=? ORDER BY title");
		$query->execute([$_GET["complex"]]);
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	} else {
		$query = $db->prepare("SELECT title, thumbnail FROM `movie`");
		$query->execute();
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	}

	$query = $db->prepare("SELECT name, street FROM `complex`");
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
		<h3 style="font-family: Montserrat, sans-serif;padding-left:.5rem">Filter by complex:</h3>
		<div class="selectComplex">
			<a href="showtimes.php"style="font-family: Montserrat, sans-serif; padding-left:.5rem">No filter</a><br>
	<table class="complexTable">
	<tr><th>Complex</th><th>Address</th></tr>
<?PHP
		foreach($complexes as $complex) {
?>
				<tr><td>
				<a style="font-family: Montserrat, sans-serif;" href="showtimes.php?complex=<?PHP echo(htmlspecialchars(urlencode($complex["name"]))); ?>">
					<?PHP echo(htmlspecialchars($complex["name"]) . ' </a> </td> <td>' . htmlspecialchars($complex["street"]) . '</td>'); ?>
				</tr>
<?PHP
	}
?>
	</table>
		</div>
		<br>
		<h3 style="font-family: Montserrat, sans-serif;">View movie showtimes:</h3>
		<div class="selectMovie">
<?PHP
	for($i=0; $i<count($movies); ) {
		$title = $movies[$i]["title"];
?>
			<div class="movieEntry">
				<div class="promoMovieTitle">
					<a href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($title))); ?>">
						<?PHP echo(htmlspecialchars($title)); ?>
					</a>
				</div>
				<div class="promoMovieThumbnail">
					<a href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($title))); ?>">
						<img src="<?PHP echo(htmlspecialchars($movies[$i]["thumbnail"])); ?>"></img>
					</a>
				</div>
				<div class="promoMovieShowings">
<?PHP
		do {
			echo('<a href="showing.php?id=' . htmlspecialchars(urlencode($movies[$i]["showingID"])) . '">' . htmlspecialchars($movies[$i]["startTime"]) . '</a><br/>');
			$i++;
		} while(isset($movies[$i]) && $movies[$i]["title"] === $title);
?>
				</div>
			</a>
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
