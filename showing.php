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
	</head>
	<body>
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
	</body>
</html>
