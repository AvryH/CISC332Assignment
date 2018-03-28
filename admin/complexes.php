<?php
	require_once(__DIR__ . "/../connect.php");
	require_once(__DIR__ . "/ensure_admin.php");
	require_once(__DIR__ . "/form.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "create") {
			$stmt = $db->prepare("INSERT INTO `complex`(name, numTheaters, street, city, pc, phoneNum) VALUES(:name, :numTheaters, :street, :city, :pc, :phoneNum);");
			$stmt->bindValue(":name", $_POST["name"]);
			$stmt->bindValue(":numTheaters", $_POST["numTheaters"]);
			$stmt->bindValue(":street", $_POST["street"]);
			$stmt->bindValue(":city", $_POST["city"]);
			$stmt->bindValue(":pc", $_POST["pc"]);
			$stmt->bindValue(":phoneNum", $_POST["phoneNum"]);
			$stmt->execute();
		} else if($_POST["action"] === "update") {
			$stmt = $db->prepare("UPDATE `complex` SET name=:name, numTheaters=:numTheaters, street=:street, city=:city, pc=:pc, phoneNum=:phoneNum WHERE name=:old_name;");
			$stmt->bindValue(":name", $_POST["name"]);
			$stmt->bindValue(":numTheaters", $_POST["numTheaters"]);
			$stmt->bindValue(":street", $_POST["street"]);
			$stmt->bindValue(":city", $_POST["city"]);
			$stmt->bindValue(":pc", $_POST["pc"]);
			$stmt->bindValue(":phoneNum", $_POST["phoneNum"]);
			$stmt->bindValue(":old_name", $_POST["old_name"]);
			$stmt->execute();
		} else if($_POST["action"] == "delete") {
			$stmt = $db->prepare("DELETE FROM `complex` WHERE name=:old_name;");
			$stmt->bindValue(":old_name", $_POST["old_name"]);
			$stmt->execute();
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<link rel="shortcut icon" href="/royalTheaters.ico" type=”image/x-icon” />
	</head>
	<body>
		<a href=".">Back to admin panel</a><br/><br/>
		<div class="table">
<?PHP
	$spec = ["name", "numTheaters", "street", "city", "pc", "phoneNum"];
	$primary = ["name"];
	echoHeader($spec);
	echoCreate($spec);

	// Load all complexes
	$query = $db->prepare("SELECT * FROM `complex`");
	$query->execute();
	$complexes = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($complexes as $complex) {
		echoUpdate($spec, $primary, $complex);
	}
?>
		</div>
	</body>
</html>
