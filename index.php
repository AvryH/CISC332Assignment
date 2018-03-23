<?PHP
	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	// Load all movies from the database
	$query = $db->prepare("SELECT title FROM `movie`");
	$query->execute();
	$movies = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="styling.css"/>
	</head>
	<body>
		<a href="signIn.php">Sign In</a>
		<a href="signUp.php">Sign Up</a>
<?PHP
	foreach($movies as $movie) {
?>
		<br>
		<a class="movieListing" href="movie.php?title=<?PHP echo(htmlspecialchars(urlencode($movie["title"]))); ?>">
			<?PHP echo(htmlspecialchars($movie["title"])); ?>
		</a>
<?PHP
	}
?>


	</body>
</html>