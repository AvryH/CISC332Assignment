<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	//////////
	// Valid types of request to this page:
	// POST action="cancelPurchase", acctNumber=?, showingID=? | Removes the purchase from the database
	// GET | Returns this page
	//////////

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "cancelPurchase") {
			// Cancel the purchase
			$query = $db->prepare("DELETE FROM `reservation` WHERE showingID=:showingID AND accountNum=:accountNum");
			$query->bindValue(":accountNum", $_SESSION["acctNumber"]);
			$query->bindValue(":showingID", $_POST["showingID"]);
			$query->execute();
		}
	}
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
		<div style="padding-left:1rem; padding-top:1rem; padding-bottom: 1rem;">
		<a style="font-family: Montserrat, sans-serif;" href=".">Back to main site</a><br/><br/>
		<table>
			<tr><th>Movie</th><th>Theater</th><th>Time</th><th>Number of Seats</th><th>Action</th></tr>
<?PHP
	// Load purchases from the database
	$query = $db->prepare("SELECT showingID, numTicketsReserved, movieTitle, complexName, theaterNum, startTime FROM `reservation` NATURAL JOIN `showing` WHERE accountNum=? ORDER BY startTime");
	$query->execute([$_SESSION["acctNumber"]]);
	$purchases = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($purchases as $purchase) {
		echo('<tr><td>' . htmlspecialchars($purchase["movieTitle"]) . '</td><td>' . htmlspecialchars($purchase["complexName"]) . ' #' . htmlspecialchars($purchase["theaterNum"]) . '</td><td>' . htmlspecialchars($purchase["startTime"]) . '</td><td>' . htmlspecialchars($purchase["numTicketsReserved"]) . '</td><td><form method="POST"><input type="hidden" name="action" value="cancelPurchase"></input><input type="hidden" name="showingID" value="' . htmlspecialchars($purchase["showingID"]) . '"></input><input type="submit" value="Cancel"></form></td></tr>');
	}
?>
		</table>
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
