<?php
	require_once(__DIR__ . "/../connect.php");
	require_once(__DIR__ . "/ensure_admin.php");
	require_once(__DIR__ . "/form.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "create") {
			$stmt = $db->prepare("INSERT INTO `movie`(title, runtime, rating, plotSyn, director, mainActors, prodComp, startDate, endDate, genre, supplier) VALUES(:title, :runtime, :rating, :plotSyn, :director, :mainActors, :prodComp, :startDate, :endDate, :genre, :supplier);");
			$stmt->bindValue(":title", $_POST["title"]);
			$stmt->bindValue(":runtime", $_POST["runtime"]);
			$stmt->bindValue(":rating", $_POST["rating"]);
			$stmt->bindValue(":plotSyn", $_POST["plotSyn"]);
			$stmt->bindValue(":director", $_POST["director"]);
			$stmt->bindValue(":mainActors", $_POST["mainActors"]);
			$stmt->bindValue(":prodComp", $_POST["prodComp"]);
			$stmt->bindValue(":startDate", $_POST["startDate"]);
			$stmt->bindValue(":endDate", $_POST["endDate"]);
			$stmt->bindValue(":genre", $_POST["genre"]);
			$stmt->bindValue(":supplier", $_POST["supplier"]);
			$stmt->execute();
		} else if($_POST["action"] === "update") {
			$stmt= $db->prepare("UPDATE `movie` SET title=:title, runtime=:runtime, rating=:rating, plotSyn=:plotSyn, director=:director, mainActors=:mainActors, prodComp=:prodComp, startDate=:startDate, endDate=:endDate, genre=:genre,  supplier=:supplier WHERE title=:old_title");
			$stmt->bindValue(":title", $_POST["title"]);
		  $stmt->bindValue(":runtime", $_POST["runtime"]);
			$stmt->bindValue(":rating", $_POST["rating"]);
			$stmt->bindValue(":plotSyn", $_POST["plotSyn"]);
			$stmt->bindValue(":director", $_POST["director"]);
			$stmt->bindValue(":mainActors", $_POST["mainActors"]);
			$stmt->bindValue(":prodComp", $_POST["prodComp"]);
			$stmt->bindValue(":startDate", $_POST["startDate"]);
			$stmt->bindValue(":endDate", $_POST["endDate"]);
			$stmt->bindValue(":genre", $_POST["genre"]);
			$stmt->bindValue(":supplier", $_POST["supplier"]);
			$stmt->bindValue(":old_title", $_POST["old_title"]);
			$stmt->execute();
		} else if($_POST["action"] == "delete") {
			$stmt = $db->prepare("DELETE FROM `movie` WHERE title=:old_title;");
			$stmt->bindValue(":old_title", $_POST["old_title"]);
			$stmt->execute();
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<a href=".">Back to admin panel</a>
		<div class="table">
<?PHP
	$spec = ["title", "runtime", "rating", "plotSyn", "director", "mainActors", "prodComp", "startDate", "endDate", "genre", "supplier"];
	$primary = ["title"];
	echoHeader($spec);
	echoCreate($spec);

	$query = $db->prepare("SELECT * FROM `movie`");
	$query->execute();
	$members = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($members as $member) {
		echoUpdate($spec, $primary, $member);
	}
?>
		</div>
	</body>
</html>
