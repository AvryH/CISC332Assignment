<!DOCTYPE html>


<?PHP
	//////////
	// Valid types of request to this page:
	// POST | Creates and logs in a new user
	// GET | Returns this page
	//////////

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		// Connect to the server
		require_once(__DIR__ . "/connect.php");

		// Try to add the user
		$query = $db->prepare("INSERT INTO customer (acctNum, fName, lName, phoneNum, street, city, pc, email, CCNum, CCExp, password, administrator) VALUES (:acctNum, :fName, :lName, :phoneNum, :street, :city, :pc, :email, :CCNum, :CCExp, :password, :administrator);");

		$acctNumber = random_int(0, 1<<30);

		$query->bindValue(":acctNum", $acctNumber);
		$query->bindValue(":fName", $_POST["fName"]);
		$query->bindValue(":lName", $_POST["lName"]);
		$query->bindValue(":phoneNum", $_POST["phoneNum"]);
		$query->bindValue(":street", $_POST["street"]);
		$query->bindValue(":city", $_POST["city"]);
		$query->bindValue(":pc", $_POST["pc"]);
		$query->bindValue(":email", $_POST["email"]);
		$query->bindValue(":CCNum", $_POST["CCNum"]);
		$query->bindValue(":CCExp", $_POST["CCExp"]);
		$query->bindValue(":password", password_hash($_POST["password"], PASSWORD_DEFAULT));
		$query->bindValue(":administrator", 0);

		$worked = $query->execute();

		if($worked) {
			// Redirect to the home page
			$_SESSION["acctNumber"] = $acctNumber;
			header("Location: index.php");
		} else {
			// Display some error
			echo('<span style="color:red;">Error creating account:</span><br>');
			echo('That email is in use by another account.<br>Please use a different one.');
			//print_r($db->errorInfo());
			//exit(1);
		}
	}
		// Show the normal page
?>
<html>
	<!-- This is the sign in page -->
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
		<script src="javaScript.js"></script>

		<!-- Theme Styles -->
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
	<center>
		<h1>Sign Up:</h1>

		<form method="POST">
			<p>Name:<p>
			<input name="fName" type="text" placeholder="First Name" autofocus="autofocus" required></input><br>
			<input name="lName" type="text" placeholder="Last Name" required></input><br>
			<p>Phone Number:<p>
			<input name="phoneNum" type="tel" placeholder="phoneNum" required></input><br>
			<p>Address:<p>
			<input name="street" type="text" placeholder="Street Address" required></input><br>
			<input name="city" type="text" placeholder="City" required></input><br>
			<input name="pc" type="text" placeholder="Postal Code" required></input><br>
			<p>Email:<p>
			<input name="email" type="email" placeholder="email" required></input><br>
			<p>Credit Card Number:<p>
			<input name="CCNum" type="text" placeholder="CCNum"></input><br>
			<p>Credit Card Expiry Date:<p>
			<input name="CCExp" type="text" placeholder="mmyy"></input><br>
			<p>Password:<p>
			<input name="password" id="password" type="password" placeholder="password" required onkeyup='arePWtheSame();'></input><br>
			<p>Confirm Password:<p>
			<input name="confirm_password" id="confirm_password" type="password" placeholder="confirm_password" required onkeyup='arePWtheSame();'></input><br>
			<span id='areMatching'></span><br><br>
			<input id="submit" type="submit" value="Sign Up"></input><br>
		</form>
	</center>
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
