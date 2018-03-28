<?PHP
	//////////
	// Valid types of request to this page:
	// POST action="addReview" title=? customerReview=? customerRating=? | Adds a review into the `watched` table for this customer
	// GET title=? | Returns the page for the movie with the given title
	//////////

	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "addReview") {
			$query = $db->prepare("INSERT INTO `watched`(acctNum, title, customerRating, customerReview) VALUES (?, ?, ?, ?)");
			$query->execute([$_SESSION["acctNumber"], $_POST["title"], $_POST["customerRating"], $_POST["customerReview"]]);
		}
	}

	// Load the movie from the database
	$query = $db->prepare("SELECT * FROM `movie` WHERE title=?");
	$query->execute([$_REQUEST["title"]]);
	$movie = $query->fetch(PDO::FETCH_ASSOC);

	// Load the list of actors from the database
	$query = $db->prepare("SELECT * FROM `mainactors` WHERE MovieTitle=?");
	$query->execute([$_REQUEST["title"]]);
	$actors = $query->fetchAll(PDO::FETCH_ASSOC);

	// Load the list of showings from the database
	$query = $db->prepare("SELECT showingID, complexName, theaterNum, startTime FROM `showing` WHERE movieTitle=?");
	$query->execute([$_REQUEST["title"]]);
	$showings = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
		<link href="css/global/global.css" rel="stylesheet" type="text/css"/>
		<link rel="shortcut icon" href="/royalTheaters.ico" type=”image/x-icon” />
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
		<div style="padding-top: 1rem; padding-left: 1rem; padding-right:1rem;" class="movieInfo">
			<div class="movieImage"><img src="<?PHP echo(htmlspecialchars($movie["thumbnail"])); ?>"></img></div>
			<div class="movieTitle"><?PHP echo(htmlspecialchars($movie["title"])); ?></div>
			<div class="movieRating"><b>Rating</b><br><?PHP echo(htmlspecialchars($movie["rating"])); ?></div>
			<div class="moviePlot"><?PHP echo(htmlspecialchars($movie["plotSyn"])); ?></div>
			<div class="movieDirector"><b>Director</b><br><?PHP echo(htmlspecialchars($movie["director"])); ?></div>
			<div class="movieMainActors"><b>Main Actors</b><br><?PHP
	$print = [];
	foreach($actors as $actor) {
		array_push($print, htmlspecialchars($actor["FName"] . ' ' . $actor["LName"]));
	}
	echo(implode(', ', $print));
?></div>
			<div class="movieProdComp"><b>Production Company</b><br><?PHP echo(htmlspecialchars($movie["prodComp"])); ?></div>
			<div class="movieDates"><b>Starts: </b><?PHP echo(htmlspecialchars($movie["startDate"])); ?><br><b>Ends:</b><?PHP echo(htmlspecialchars($movie["endDate"])); ?></div>
			<div class="movieGenre"><b>Genre</b><br><?PHP echo(htmlspecialchars($movie["genre"])); ?></div>
			<div class="movieSupplier"><?PHP echo(htmlspecialchars($movie["supplier"])); ?></div>
		</div>

		<div style="padding-top: 1rem; padding-left: 1rem; padding-right:1rem;">
		<br><br><h3>Showings:</h3><br>
		<div class="movie_showings">
<?PHP
	foreach($showings as $show) {
		echo('<a href="showing.php?id=' . htmlspecialchars(urlencode($show["showingID"])) . '">');
		echo(htmlspecialchars($show["startTime"]) . ' ' . htmlspecialchars($show["complexName"]) . ' #' . htmlspecialchars($show["theaterNum"]));
		echo('</a><br/>');
	}
?>
</div>
		</div>

<div style="padding-top: 1rem; padding-left: 1rem; padding-right:1rem; padding-bottom:1rem;">
		<br>
<?PHP
	$stmt = $db->prepare("SELECT AVG(customerRating) FROM `watched` WHERE title=?");
	$stmt->execute([$_GET["title"]]);
	$avg = $stmt->fetchColumn();
	if($avg !== null) {
?>
		<div class="averageReview">
		Average rating: <?PHP echo(htmlspecialchars($avg)); ?>
		</div>
		<table>
			<tr><th>Rating</th><th>Review</th><th>Poster</th></tr>
			<?PHP
				// Load the reviews
				$query = $db->prepare("SELECT customerRating, customerReview, fName FROM `watched` NATURAL JOIN `customer` WHERE title = ? ORDER BY customerRating DESC");
				$query->execute([$_REQUEST["title"]]);
				$cusReviews = $query->fetchAll(PDO::FETCH_ASSOC);

				//var_dump ($cusReviews);
				foreach($cusReviews as $rev) {
					echo("<tr><td>");
					if(isset($rev)) {
						echo(htmlspecialchars($rev["customerRating"]));
					}
					echo("</td><td>");
					if(isset($rev)) {
						echo(htmlspecialchars($rev["customerReview"]));
					}
					echo("</td><td>");
					if(isset($rev)) {
						echo(htmlspecialchars($rev["fName"]));
					}
					echo("</td></tr>");
				}
			?>
		</table>
<?PHP
	} else {
?>
No reviews yet...
<?PHP
	}
?>
<?PHP
	// Only show the "add review" section to users who are logged in
	if(isset($_SESSION["acctNumber"])) {
?>
		<br><br>Add review:<br>
		<form method="POST">
			<input name="action" type="hidden" value="addReview"></input>
			<input name="title" type="hidden" value="<?PHP echo($_REQUEST["title"]); ?>"></input>
			<textarea name="customerReview" placeholder="Review text"></textarea>
			<input name="customerRating" type="number" placeholder="Rating from 1-5 stars"></input>
			<input type="submit" value="Submit review"></input>
		</form>
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
