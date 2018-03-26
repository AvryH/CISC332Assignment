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
	</head>
	<body>
		<table>
			<tr><th>Movie</th><th>Theater</th><th>Time</th><th>Number of Seats</th><th>Action</th></tr>
<?PHP
	// Load purchases from the database
	$query = $db->prepare("SELECT showingID, numTicketsReserved, movieTitle, complexName, theaterNum, startTime FROM `reservation` NATURAL JOIN `showing` WHERE accountNum=?");
	$query->execute([$_SESSION["acctNumber"]]);
	$purchases = $query->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($purchases as $purchase) {
		echo('<tr><td>' . htmlspecialchars($purchase["movieTitle"]) . '</td><td>' . htmlspecialchars($purchase["complexName"]) . ' #' . htmlspecialchars($purchase["theaterNum"]) . '</td><td>' . htmlspecialchars($purchase["startTime"]) . '</td><td>' . htmlspecialchars($purchase["numTicketsReserved"]) . '</td><td><form method="POST"><input type="hidden" name="action" value="cancelPurchase"></input><input type="hidden" name="showingID" value="' . htmlspecialchars($purchase["showingID"]) . '"></input><input type="submit" value="Cancel"></form></td></tr>');
	}
?>
		</table>
	</body>
</html>
