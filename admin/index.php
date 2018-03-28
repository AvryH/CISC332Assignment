<?php
require_once(__dir__ . "/../connect.php");
require_once(__dir__ . "/ensure_admin.php");
?>
<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" href="/royalTheaters.ico" type=”image/x-icon” />
	</head>
	<body>
		<a href="..">Back to main site</a><br/><br/>
		<a href="users.php">Modify members</a><br/>
		<a href="movies.php">Modify movies</a><br/>
		<a href="complexes.php">Modify complexes</a><br/>
		<a href="theaters.php">Modify theaters</a><br/>
		<a href="showings.php">Modify showings</a><br/><br/>
		<table>
			<tr><th>Rank</th><th>Most popular movies</th><th>Tickets Sold</th><th>Most popular complexes</th><th>Tickets Sold</th></tr>
			<?PHP
				// Load the most popular movies from the database
				$query = $db->prepare("SELECT movieTitle, SUM(numTicketsReserved) as ticketsSold FROM `reservation` NATURAL JOIN `showing` GROUP BY movieTitle ORDER BY SUM(numTicketsReserved) DESC LIMIT 10");
				$query->execute();
				$movies = $query->fetchAll(PDO::FETCH_ASSOC);

				// Load the most popular complexes from the database
				$query = $db->prepare("SELECT complexName, SUM(numTicketsReserved) as ticketsReserved FROM `reservation` NATURAL JOIN `showing` GROUP BY complexName ORDER BY SUM(numTicketsReserved) DESC LIMIT 10");
				$query->execute();
				$complexes = $query->fetchAll(PDO::FETCH_ASSOC);

				for($index=0; $index<10; $index++) {
					if(!isset($movies[$index]) && !isset($movies[$index])) {
						break;
					}
					echo("<tr><td>#" . ($index + 1) . "</td><td>");
					if(isset($movies[$index])) {
						echo(htmlspecialchars($movies[$index]["movieTitle"]));
					}
					echo("</td><td>");
					if(isset($movies[$index])) {
						echo(htmlspecialchars($movies[$index]["ticketsSold"]));
					}
					echo("</td><td>");
					if(isset($complexes[$index])) {
						echo(htmlspecialchars($complexes[$index]["complexName"]));
					}
					echo("</td><td>");
					if(isset($complexes[$index])) {
						echo(htmlspecialchars($complexes[$index]["ticketsReserved"]));
					}
					echo("</td></tr>");
				}
			?>
		</table>
	</body>
</html>
