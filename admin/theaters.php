<?php
	require_once(__DIR__ . "/../connect.php");
	require_once(__DIR__ . "/ensure_admin.php");
	require_once(__DIR__ . "/form.php");

	if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] === "create") {
			$stmt = $db->prepare("INSERT INTO `theater`(complexName, theaterNum, maxNumOfSeat, screenSize) VALUES(:complexName, :theaterNum, :maxNumOfSeat, :screenSize);");
			$stmt->bindValue(":complexName", $_POST["complexName"]);
			$stmt->bindValue(":theaterNum", $_POST["theaterNum"]);
			$stmt->bindValue(":maxNumOfSeat", $_POST["maxNumOfSeat"]);
			$stmt->bindValue(":screenSize", $_POST["screenSize"]);
			$stmt->execute();
		} else if($_POST["action"] === "update") {
			$stmt = $db->prepare("UPDATE `theater` SET complexName=:complexName, theaterNum=:theaterNum, maxNumOfSeat=:maxNumOfSeat, screenSize=:screenSize WHERE complexName=:old_complexName AND theaterNum=:old_theaterNum;");
			$stmt->bindValue(":complexName", $_POST["complexName"]);
			$stmt->bindValue(":theaterNum", $_POST["theaterNum"]);
			$stmt->bindValue(":maxNumOfSeat", $_POST["maxNumOfSeat"]);
			$stmt->bindValue(":screenSize", $_POST["screenSize"]);
			$stmt->bindValue(":old_complexName", $_POST["old_complexName"]);
			$stmt->bindValue(":old_theaterNum", $_POST["old_theaterNum"]);
			$stmt->execute();
		} else if($_POST["action"] == "delete") {
			$stmt = $db->prepare("DELETE FROM `theater` WHERE complexName=:old_complexName AND theaterNum=:old_theaterNum;");
			$stmt->bindValue(":old_complexName", $_POST["old_complexName"]);
			$stmt->bindValue(":old_theaterNum", $_POST["old_theaterNum"]);
			$stmt->execute();
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
	</head>
	<body>
		<a href=".">Back to admin panel</a>
		<table>
<?PHP
	$spec = ["complexName", "theaterNum", "maxNumOfSeat", "screenSize"];
	$primary = ["complexName", "theaterNum"];
	echoHeader($spec);
	echoCreate($spec);

	// Load all complexes
	$query = $db->prepare("SELECT * FROM `theater`");
	$query->execute();
	$members = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($members as $member) {
		echoUpdate($spec, $primary, $member);
	}
?>
		</table>
	</body>
</html>
