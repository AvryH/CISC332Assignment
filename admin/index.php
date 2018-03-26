<?php
require_once(__dir__ . "/../connect.php");
require_once(__dir__ . "/ensure_admin.php");
?>
<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<a href="users.php">Modify members</a><br/>
		<a href="movies.php">Modify movies</a><br/>
		<a href="complexes.php">Modify complexes</a><br/>
		<a href="theaters.php">Modify theaters</a><br/>
		<a href="showings.php">Modify showings</a><br/>
		<table>
			<tr><th>Rank</th><th>Most popular movies</th><th>Most popular complexes</th></tr>
			<?PHP
				// Load the most popular movies from the database
				$query = $db->prepare("SELECT movieTitle FROM `reservation` NATURAL JOIN `showing` GROUP BY movieTitle ORDER BY COUNT(*) LIMIT 10");
				$query->execute();
				$movies = $query->fetchAll(PDO::FETCH_ASSOC);

				// Load the most popular complexes from the database
				$query = $db->prepare("SELECT complexName FROM `reservation` NATURAL JOIN `showing` GROUP BY complexName ORDER BY COUNT(*) LIMIT 10");
				$query->execute();
				$movies = $query->fetchAll(PDO::FETCH_ASSOC);

				for($index=0; $index<10; $index++) {
					if(!isset($movies[$index]) && !isset($movies[$index])) {
						break;
					}
					echo("<tr><td>#" . ($index + 1) . "</td><td>" . $movies[$index] . "</td><td>" . $complexes[$index] . "</td></tr>");
				}
			?>
		</table>
	</body>
</html>
