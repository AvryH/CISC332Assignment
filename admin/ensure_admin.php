<?PHP
	// Connect to the server
	require_once(__DIR__ . "/../connect.php");

	$stmt = $db->prepare("SELECT administrator FROM `customer` WHERE acctNum=?");
	if(!$stmt->execute([$_SESSION["acctNumber"]])) {
		echo("Failed to authenticate");
		exit();
	}

	if($stmt->fetchColumn() !== '1') {
		echo("You are not an administrator");
		exit();
	}
?>
