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
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
	</head>
	<body>
		<form method="POST">
			<input name="fName" type="text" placeholder="fName"></input><br>
			<input name="lName" type="text" placeholder="lName"></input><br>
			<input name="phoneNum" type="text" placeholder="phoneNum"></input><br>
			<input name="street" type="text" placeholder="street"></input><br>
			<input name="city" type="text" placeholder="city"></input><br>
			<input name="pc" type="text" placeholder="pc"></input><br>
			<input name="email" type="text" placeholder="email"></input><br>
			<input name="CCNum" type="text" placeholder="CCNum"></input><br>
			<input name="CCExp" type="text" placeholder="CCExp"></input><br>
			<input name="password" type="text" placeholder="password"></input><br>
			<input type="submit" value="Sign Up"></input><br>
		</form>
	</body>
</html>
<?PHP
	}
?>
