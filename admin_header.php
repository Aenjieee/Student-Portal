<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
</head>
<body>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = $_SESSION['id'];
require_once('mysql_connection.php'); // Assuming this file contains your database connection

$selectquery = "SELECT * FROM accounts where id = '".$id."'";
$selectresult = mysqli_query($bd, $selectquery); // Assuming $bd is your database connection variable

while ($row = mysqli_fetch_array($selectresult)){
	$picture = $row['picture'];
	$lastname = $row['lastname'];
	$firstname = $row['firstname'];
}
?>
	<table>
		<tr>
			<th style="text-align: right;" width="33.3%"></th>
			<th style="text-align: center;"  width="33.4%">
				<a href="view_accounts.php" style="text-decoration: none;background-color: #21f794;color: #000;padding: 10px 20px;font-weight: bolder;border: 3px solid #d05a5a;border-style: inset;">Teachers Account</a>
				<a href="create_account.php" style="text-decoration: none;background-color: #21f794;color: #000;padding: 10px 20px;font-weight: bolder;border: 3px solid #d05a5a;border-style: inset;">Create Account</a>
				<a href="logout.php" style="text-decoration: none;background-color: #21f794;color: #000;padding: 10px 20px;font-weight: bolder;border: 3px solid #d05a5a;border-style: inset;">Logout</a>
			</th>
		</tr>
	</table>
</body>
</html>
