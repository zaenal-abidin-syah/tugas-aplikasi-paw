<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Banking | <?php echo $title ?></title>
	<link rel="stylesheet" href="css/style1.css">
</head>
<body>
	<div class="container">
		<!-- nav start -->
		<?php if (isset($_SESSION['admin'])): ?>
			<!-- nav header admin -->	
			<nav class="nav">
				<div class="header">Banking</div>
				<div class="nav-bar">
					<a class="browse" href="browse.php">Browse</a>
					<a class="register" href="register.php">Register</a>
					<a class="logout" href="logout.php">Logout</a>
				</div>
			</nav>	
		<?php elseif (isset($_SESSION['customer'])): ?>
		    <!-- nav untuk customer -->
		  	<nav class="nav">
				<div class="header">Banking</div>
				<div class="nav-bar">
					<a href="profil.php" class="profil">Profil</a>
					<a class="logout" href="logout.php">Logout</a>
				</div>
			</nav>
		<?php else: ?>
			<!-- nav pengunjung -->
			<nav class="nav">
				<div class="header">Banking</div>
				<div class="nav-bar">
					<a href="daftar.php" class="daftar">Daftar</a>
					<a class="login" href="login.php">Login</a>
				</div>
			</nav>
		<?php endif ?>
		<!-- nav end -->