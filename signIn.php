<?PHP
	//////////
	// Valid types of request to this page:
	// POST action="login", acctNumber=?, password=? | Logs the user on
	// POST action="logout" | Logs the user off
	// POST action="updateUser" | Updates user info
	// GET | Returns this page
	//////////

	require_once(__DIR__ . "/connect.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "login") {
			// Load the hashed password from the database
			$email = $_POST["email"];
			$stmt = $db->prepare("SELECT password, acctNum FROM `customer` WHERE email=?");
			$stmt->execute([$email]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$hash = $user["password"];
			$acctNumber = $user["acctNum"];

			if($hash !== null) {
				if(password_verify($_POST["password"], $user["password"])) {
					// The password was correct
					$_SESSION["acctNumber"] = $acctNumber;
				} else {
					echo('<span style="color:red;">The password was incorrect</span>');
				}
			} else {
				echo("No user with that email was found");
			}
		} else if($_POST["action"] === "logout") {
			unset($_SESSION["acctNumber"]);
			// The user is no longer logged in
		} else if($_POST["action"] === "updateUser") {
			$query = $db->prepare("UPDATE `customer` SET fName=:fName, lName=:lName, phoneNum=:phoneNum, street=:street, city=:city, pc=:pc, email=:email, CCNum=:CCNum, CCExp=:CCExp, password=IF(ISNULL(:password),password,:password) WHERE acctNum=:acctNum;");

			$query->bindValue(":acctNum", $_SESSION["acctNumber"]);
			$query->bindValue(":fName", $_POST["fName"]);
			$query->bindValue(":lName", $_POST["lName"]);
			$query->bindValue(":phoneNum", $_POST["phoneNum"]);
			$query->bindValue(":street", $_POST["street"]);
			$query->bindValue(":city", $_POST["city"]);
			$query->bindValue(":pc", $_POST["pc"]);
			$query->bindValue(":email", $_POST["email"]);
			$query->bindValue(":CCNum", $_POST["CCNum"]);
			$query->bindValue(":CCExp", $_POST["CCExp"]);
			if(isset($_POST["password"]) && $_POST["password"] !== "") {
				$query->bindValue(":password", password_hash($_POST["password"], PASSWORD_DEFAULT));
			} else {
				$query->bindValue(":password", null);
			}

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
<center style="padding-top: 10rem; padding-bottom: 10rem;">
<?PHP
	if(isset($_SESSION["acctNumber"])) {
			$query = $db->prepare("SELECT * FROM `customer` WHERE acctNum=:acctNum;");
			$query->bindValue(":acctNum", $_SESSION["acctNumber"]);
			$query->execute();
			$user = $query->fetch(PDO::FETCH_ASSOC);
?>

		<form method="POST">
			<input name="action" type="hidden" value="logout"></input>
			<input type="submit" value="Logout"></input>
		</form>

		<a href="purchases.php">Purchases</a>
<?PHP
		if($user["administrator"]) {
?>
		<a href="admin/">Administration</a>
<?PHP
		}
?>

		<br>

		<form method="POST">
			<input name="action" type="hidden" value="updateUser"></input>
			<p>Name:<p>
			<input name="fName" type="text" placeholder="First Name" value="<?PHP echo(htmlspecialchars($user["fName"])); ?>"></input><br>
			<input name="lName" type="text" placeholder="Last Name" value="<?PHP echo(htmlspecialchars($user["lName"])); ?>"></input><br>
			<p>Phone Number:<p>
			<input name="phoneNum" type="tel" placeholder="Phone Number" value="<?PHP echo(htmlspecialchars($user["phoneNum"])); ?>"></input><br>
			<p>Address:<p>
			<input name="street" type="text" placeholder="Street" value="<?PHP echo(htmlspecialchars($user["street"])); ?>"></input><br>
			<input name="city" type="text" placeholder="City" value="<?PHP echo(htmlspecialchars($user["city"])); ?>"></input><br>
			<input name="pc" type="text" placeholder="Postal Code" value="<?PHP echo(htmlspecialchars($user["pc"])); ?>"></input><br>
			<p>Email:<p>
			<input name="email" type="Email" placeholder="Email" value="<?PHP echo(htmlspecialchars($user["email"])); ?>"></input><br>
			<p>Credit Card Number:<p>
			<input name="CCNum" type="text" placeholder="CCNum" value="<?PHP echo(htmlspecialchars($user["CCNum"])); ?>"></input><br>
			<p>Credit Card Expiry Date:<p>
			<input name="CCExp" type="text" placeholder="mmyy" value="<?PHP echo(htmlspecialchars($user["CCExp"])); ?>"></input><br>
			<p>Password:<p>
			<input name="password" type="password" placeholder="(password unchanged)"></input>
			<input type="submit" value="Update"></input><br>
		</form>

<?PHP
	} else {
		// Show the log in page.
?>
		<form method="POST">
			<input name="action" type="hidden" value="login"></input>
			<input name="email" type="text" placeholder="email"></input>
			<input name="password" type="password" placeholder="password"></input>
			<input type="submit" value="Login"></input>
		</form>
		<a style="font-family: Montserrat, sans-serif;" href="signUp.php">Sign Up</a>
<?PHP
	}
?>
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
