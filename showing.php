<?PHP
	//////////
	// Valid types of request to this page:
	// POST action="buyTicket" numTicketsReserved=? | Buys a number of tickets for the showing
	// GET id=? | Returns the page for the showing with the given id
	//////////

	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "buyTicket") {
			// Check if there are enough seats left. If there are enough, buy the tickets
			$query = $db->prepare("INSERT INTO `reservation`(accountNum, showingID, numTicketsReserved) SELECT :accountNum, :showingID, :numTicketsReserved WHERE (SELECT maxNumOfSeat FROM `showing` NATURAL JOIN `theater` WHERE showingID=:showingID) - (SELECT COALESCE(SUM(numTicketsReserved), 0) FROM `reservation` WHERE showingID=:showingID) >= :numTicketsReserved");
			$query->bindValue(":accountNum", $_SESSION["acctNumber"]);
			$query->bindValue(":showingID", $_POST["id"]);
			$query->bindValue(":numTicketsReserved", $_POST["numTicketsReserved"]);
			if(!$query->execute()) {
				echo("You already have tickets for this showing. Please cancel them before adding more.");
			} else if($query->rowCount() < 1) {
				echo("The theater doesn't have enough seats remaining.");
			}
		}
	}

	// Load the showing
	$query = $db->prepare("SELECT complexName, theaterNum, startTime, movieTitle FROM `showing` WHERE showingID=?");
	$query->execute([$_REQUEST["id"]]);
	$showing = $query->fetch(PDO::FETCH_ASSOC);
?>
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
<?PHP
	if(!isset($_SESSION["acctNumber"])) {
?>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signIn.php" class="s-header-v2__nav-link">Sign In</a></li>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signUp.php" class="s-header-v2__nav-link">Sign Up</a></li>
<?PHP
	} else {
?>
																<li style="padding-top: 150px;" class="s-header-v2__nav-item"><a href="signIn.php" class="s-header-v2__nav-link">Account</a></li>
<?PHP
	}
?>
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
		<h3>Buying tickets for:</h3>
		<div class="showingMovie"><?PHP
			echo(htmlspecialchars($showing["movieTitle"]));
		?></div>
		<div class="showingMovie"><?PHP
			echo(htmlspecialchars($showing["complexName"]) . ' #' . htmlspecialchars($showing["theaterNum"]));
		?></div>
		<div class="showingStartTime"><?PHP
			echo("Starting at: " . htmlspecialchars($showing["startTime"]));
		?></div>
		<br>
		<form method="POST">
			<input name="action" type="hidden" value="buyTicket"></input>
			<input name="id" type="hidden" value="<?PHP echo(htmlspecialchars($_REQUEST["id"])); ?>"></input>
			<input name="numTicketsReserved" type="number" placeholder="Number of tickets"></input>
			<input type="submit" value="Buy tickets"></input>
		</form>
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
