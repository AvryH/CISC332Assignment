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

		$acctNumber = random_int(0, pow(2,32)-1);

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
			echo("Error creating account");
			exit(1);
		}
	} else {
		// Show the normal page
?>
<html>
	<!-- This is the sign in page -->
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
	</head>
	<body>
		<h1>Sign Up:</h1>

		<form method="POST">
			<p>First name:<p>
			<input name="fName" type="text" placeholder="fName" required></input><br>
			<p>Last name: <p>
			<input name="lName" type="text" placeholder="lName" required></input><br>
			<p>Phone Number:<p>
			<input name="phoneNum" type="tel" placeholder="phoneNum" required></input><br>
			<p>Street Address:<p>
			<input name="street" type="text" placeholder="street" required></input><br>
			<p>City:<p>
			<input name="city" type="text" placeholder="city" required></input><br>
			<p>Postal Code:<p>
			<input name="pc" type="text" placeholder="pc" required></input><br>
			<p>Email:<p>
			<input name="email" type="email" placeholder="email" required></input><br>
			<p>Credit Card Number:<p>
			<input name="CCNum" type="text" placeholder="CCNum"></input><br>
			<p>Credit Card Expiry Date:<p>
			<input name="CCExp" type="month" placeholder="CCExp"></input><br>
			<p>Password:<p>
			<input name="password" type="password" placeholder="password" required></input><br>
			<p>Confirm Password:<p>
			<input name="password" type="password" placeholder="password" required></input><br>
			<input type="submit" value="Sign Up"></input><br>
		</form>
	</body>
</html>
<?PHP
	}
?>