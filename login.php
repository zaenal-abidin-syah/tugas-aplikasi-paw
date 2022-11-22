<?php
// session
session_start();
ob_start();
$title = 'login';

// include function
include 'functions.php';

// ketika tombol login diklik maka lakukan validasi
if (isset($_POST['login'])){
	// validasi kosong, dll
	$username = $_POST['username'];
	$password = $_POST['password'];
	$loginAs = $_POST['as'];
	// check apakah sama dengan data yang ada di database
	if(checkLogin($username, $password, $loginAs)){
		$_SESSION[$loginAs] = true;
		$sesi = $_SERVER['HTTP_HOST'];
		header("Location: http://$sesi/tugas-aplikasi/index.php");
		exit();
	}
}
?>
<?php include 'include/header.php' ?>

	<h1>Ini adalah halaman login</h1>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<h4>login sebagai</h4>
		Admin<input type="radio" name="as" value="admin">
		Customer<input type="radio" name="as" value="customer"><br><br>
		<label for="username">username</label>
		<input type="text" name="username" id="username"><br><br>
		<label for="password">password</label>
		<input type="password" name="password" id="password"><br><br>
		<button type="submit" name="login" value="login">login</button>
	</form>
<?php include 'include/footer.php' ?>