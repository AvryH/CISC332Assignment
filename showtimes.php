<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	// Load all movies from the database
	if(isset($_GET["complex"])) {
		$query = $db->prepare("SELECT title FROM `movie` JOIN `showing` ON movieTitle=title WHERE complexName=?");
		$query->execute([$_GET["complex"]]);
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	} else {
		$query = $db->prepare("SELECT title FROM `movie`");
		$query->execute();
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	}

	$query = $db->prepare("SELECT name FROM `complex`");
	$query->execute();
	$complexes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
	</head>
	<body>
		<h3>Filter by complex:</h3>
		<div class="selectComplex">
			<a href="showtimes.php">No filter</a><br>
<?PHP
	foreach($complexes as $complex) {
?>
			<a href="showtimes.php?complex=<?PHP echo(htmlspecialchars(urlencode($complex["name"]))); ?>">
				<?PHP echo(htmlspecialchars($complex["name"])); ?>
			</a><br>
<?PHP
	}
?>
		</div>
		<br>
		<h3>View movie showtimes:</h3>
		<div class="selectMovie">
<?PHP
	foreach($movies as $movie) {
?>
			<a href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($movie["title"]))); ?>">
				<?PHP echo(htmlspecialchars($movie["title"])); ?>
			</a>
			<br>
<?PHP
	}
?>
		</div>
	</body>
</html>
