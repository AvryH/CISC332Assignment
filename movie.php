<?PHP
	//////////
	// Valid types of request to this page:
	// POST action="addReview" title=? customerReview=? customerRating=? | Adds a review into the `watched` table for this customer
	// GET title=? | Returns the page for the movie with the given title
	//////////

	// Connect to the server
	require_once(__DIR__ . "/connect.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "addReview") {
			$query = $db->prepare("INSERT INTO `watched`(acctNum, title, customerRating, customerReview) VALUES (?, ?, ?, ?)");
			$query->execute([$_SESSION["acctNumber"], $_POST["title"], $_POST["customerRating"], $_POST["customerReview"]]);
		}
	}

	// Load the movie from the database
	$query = $db->prepare("SELECT * FROM `movie` WHERE title=?");
	$query->execute([$_REQUEST["title"]]);
	$movie = $query->fetch(PDO::FETCH_ASSOC);

	// Load the list of showings from the database
	$query = $db->prepare("SELECT showingID, complexName, theaterNum, startTime FROM `showing` WHERE movieTitle=?");
	$query->execute([$_REQUEST["title"]]);
	$showings = $query->fetchAll(PDO::FETCH_ASSOC);

?>

Movie:<br>
<?PHP
	print_r($movie);
?>

<br><br>Showings:<br>
<div class="movie_showings">
<?PHP
	foreach($showings as $show) {
		echo('<a href="showing.php?id=' . htmlspecialchars(urlencode($show["showingID"])) . '">');
		echo(htmlspecialchars($show["startTime"]) . ' ' . htmlspecialchars($show["complexName"]) . ' #' . htmlspecialchars($show["theaterNum"]));
		echo('</a><br/>');
	}
?>
</div>

<?PHP
	// Only show the "add review" section to users who are logged in
	if(isset($_SESSION["acctNumber"])) {
?>
<br><br>Add review:<br>
<form method="POST">
	<input name="action" type="hidden" value="addReview"></input>
	<input name="title" type="hidden" value="<?PHP echo($_REQUEST["title"]); ?>"></input>
	<textarea name="customerReview" placeholder="Review text"></textarea>
	<input name="customerRating" type="number" placeholder="Rating from 1-5 stars"></input>
	<input type="submit" value="Submit review"></input>
</form>
<?PHP
	}
?>

<br><br>Reviews:<br>


<table>
			<tr><th>Rating</th><th>Review</th><th>Poster</th></tr>
			<?PHP
				// Load the reviews
				$query = $db->prepare("SELECT customerRating, customerReview, fName FROM `watched` NATURAL JOIN `customer` WHERE title = ? ORDER BY customerRating DESC");
				$query->execute([$_REQUEST["title"]]);
				$cusReviews = $query->fetchAll(PDO::FETCH_ASSOC);
				
				//var_dump ($cusReviews);
				foreach($cusReviews as $rev) {
					echo("<tr><td>");
					if(isset($rev)) {
						echo(htmlspecialchars($rev["customerRating"]));
					}
					echo("</td><td>");
					if(isset($rev)) {
						echo(htmlspecialchars($rev["customerReview"]));
					}
					echo("</td><td>");
					if(isset($rev)) {
						echo(htmlspecialchars($rev["fName"]));
					}
					echo("</td></tr>");
				}
			?>
		</table>
