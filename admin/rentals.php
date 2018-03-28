<?php
require_once(__dir__ . "/../connect.php");
require_once(__dir__ . "/ensure_admin.php");
require_once(__DIR__ . "/form.php");
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" href="/royalTheaters.ico" type=”image/x-icon” />
	</head>
	<body>
		<a href=".">Back to admin panel</a>
		<div class="table">
			<?PHP
				$spec = ["movieTitle", "complexName", "theaterNum", "startTime", "numTicketsReserved"];
				echoHeader($spec);

				// Load all rentals from the database
				$query = $db->prepare("SELECT * FROM `reservation` NATURAL JOIN `showing` WHERE accountNum=?");
				$query->execute([$_GET["id"]]);
				$rentals = $query->fetchAll(PDO::FETCH_ASSOC);

				foreach($rentals as $rental) {
					echoStatic($spec, $rental);
				}
			?>
		</table>
	</body>
</html>
