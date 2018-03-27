<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	// Load all movies from the database
	if(isset($_GET["complex"])) {
		$query = $db->prepare("SELECT title, thumbnail FROM `movie` JOIN `showing` ON movieTitle=title WHERE complexName=?");
		$query->execute([$_GET["complex"]]);
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	} else {
		$query = $db->prepare("SELECT title, thumbnail FROM `movie`");
		$query->execute();
		$movies = $query->fetchAll(PDO::FETCH_ASSOC);
	}

	$query = $db->prepare("SELECT name, street FROM `complex`");
	$query->execute();
	$complexes = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
	</head>
	<body>
		<h3>Filter by complex:</h3>
		<div class="selectComplex">
	<table class="complexTable">
	<tr><th>Complex</th><th>Address</th></tr>
<?PHP
		foreach($complexes as $complex) {
?>			
				<tr><td>
				<a href="showtimes.php?complex=<?PHP echo(htmlspecialchars(urlencode($complex["name"]))); ?>">
					<?PHP echo(htmlspecialchars($complex["name"]) . ' </a> </td> <td>' . htmlspecialchars($complex["street"]) . '</td>'); ?>
				</tr>
<?PHP
	}
?>
	</table>
		</div>
		<br>
		<h3>View movie showtimes:</h3>
		<div class="selectMovie">
<?PHP
	foreach($movies as $movie) {
?>
			<a href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($movie["title"]))); ?>">
				<div class="movieThumbnail">
					<img src="<?PHP echo(htmlspecialchars($movie["thumbnail"])); ?>"></img>
				</div>
				<div class="movieTitle">
					<?PHP echo(htmlspecialchars($movie["title"])); ?>
				</div>
			</a>
			<br>
<?PHP
	}
?>
		</div>
	</body>
</html>
