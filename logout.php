<?php 
	echo '<script>alert("Goodbye!")</script>';
	session_start();
	$_SESSION["id"] = "";
	session_destroy();
	header('location: index.php');
?>