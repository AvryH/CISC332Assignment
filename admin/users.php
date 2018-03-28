<?php
require_once(__dir__ . "/../connect.php");
require_once(__dir__ . "/ensure_admin.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
	if($_POST["action"] == "deleteUser") {
		$stmt = $db->prepare("DELETE FROM `customer` WHERE acctNum=?");
		$stmt->execute([$_POST["acctNum"]]);
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
		<table>
			<tr>
				<th>Account Number</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>email</th>
				<th>Role</th>
				<th>Information</th>
				<th>Actions</th>
			</tr>
			<?PHP
				// Load all members from the database
				$query = $db->prepare("SELECT acctNum, fName, lName, email, administrator FROM `customer`");
				$query->execute();
				$members = $query->fetchAll(PDO::FETCH_ASSOC);

				foreach($members as $member) {
					?>
					<tr>
					<td class="acctNum"><?PHP echo(htmlspecialchars($member["acctNum"])); ?></td>
					<td class="fName"><?PHP echo(htmlspecialchars($member["fName"])); ?></td>
					<td class="lName"><?PHP echo(htmlspecialchars($member["lName"])); ?></td>
					<td class="email"><?PHP echo(htmlspecialchars($member["email"])); ?></td>
					<td class="administrator"><?PHP if($member["administrator"]) { echo("Administrator"); } ?></td>
					<td class="rentals"><a href="rentals.php?id=<?PHP echo(htmlspecialchars(urlencode($member["acctNum"]))); ?>">View Rentals</a></td>
					<td class="delete_button"><form method="POST">
					<input name="action" type="hidden" value="deleteUser"></input>
					<input name="acctNum" type="hidden" value="<?PHP echo(htmlspecialchars($member["acctNum"])); ?>"></input>
					<input type="submit" value="delete"></input></form></td>
					</tr>
					<?PHP
				}
			?>
		</table>
	</body>
</html>
