<?php 
// require 'adminPermission.inc';
session_start();
if(!isset($_SESSION['isAdmin'])){
	$sesi = $_SERVER['HTTP_HOST'];
	header("Location: http://$sesi/paw-9/05-challenge/login.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>coba</title>
	</head>
	<body>
		<h1>ini adalah halaman private</h1>
		<a href="logout.php">Logout</a>
	</body>
</html>