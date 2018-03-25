<?php
	require_once(__DIR__ . "/../connect.php");
	require_once(__DIR__ . "/ensure_admin.php");
	require_once(__DIR__ . "/form.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "create") {
			$stmt = $db->prepare("INSERT INTO `showing`(movieTitle, complexName, theaterNum, startTime) VALUES(:movieTitle, :complexName, :theaterNum, :startTime);");
			$stmt->bindValue(":movieTitle", $_POST["movieTitle"]);
			$stmt->bindValue(":complexName", $_POST["complexName"]);
			$stmt->bindValue(":theaterNum", $_POST["theaterNum"]);
			$stmt->bindValue(":startTime", $_POST["startTime"]);
			$stmt->execute();
		} else if($_POST["action"] === "update") {
			$stmt = $db->prepare("UPDATE `showing` SET movieTitle=:movieTitle, complexName=:complexName, theaterNum=:theaterNum, startTime=:startTime WHERE showingID=:old_showingID;");
			$stmt->bindValue(":movieTitle", $_POST["movieTitle"]);
			$stmt->bindValue(":complexName", $_POST["complexName"]);
			$stmt->bindValue(":theaterNum", $_POST["theaterNum"]);
			$stmt->bindValue(":startTime", $_POST["startTime"]);
			$stmt->bindValue(":old_showingID", $_POST["old_showingID"]);
			$stmt->execute();
		} else if($_POST["action"] == "delete") {
			$stmt = $db->prepare("DELETE FROM `showing` WHERE showingID=:old_showingID;");
			$stmt->bindValue(":old_showingID", $_POST["old_showingID"]);
			$stmt->execute();
		}
	}
	if(isset($_REQUEST["complexName"]) && isset($_REQUEST["theaterNum"])) {
?>
<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	<body>
		<a href="showings.php">Back to theater list</a>
		<div class="table">
<?PHP
	$spec = ["movieTitle", "startTime"];
	$primary = ["showingID"];
	$extra = [
		"theaterNum" => $_REQUEST["theaterNum"],
		"complexName" => $_REQUEST["complexName"]
	];
	echoHeader($spec);
	echoCreate($spec, $extra);

	$query = $db->prepare("SELECT * FROM `showing` WHERE complexName=? AND theaterNum=?");
	$query->execute([$_REQUEST["complexName"], $_REQUEST["theaterNum"]]);
	$showings = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($showings as $showing) {
		echoUpdate($spec, $primary, $showing, $extra);
	}
?>
		</div>
	</body>
</html>
<?PHP
	} else {
		// Show a list of theaters
?>
		<a href=".">Back to admin panel</a>
<?PHP
	$query = $db->prepare("SELECT * FROM `theater`");
	$query->execute();
	$theaters = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($theaters as $theater) {
		echo('<br><a href="showings.php?complexName='
			. htmlspecialchars(urlencode($theater["complexName"]))
			. '&theaterNum='
			. htmlspecialchars(urlencode($theater["theaterNum"]))
			. '">'
			. htmlspecialchars($theater["complexName"])
			. ' #'
			. htmlspecialchars($theater["theaterNum"])
			. '</a>');
	}
?>
<?PHP
 }
?>

