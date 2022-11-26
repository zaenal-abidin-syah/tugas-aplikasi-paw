<?php
// session
session_start();
ob_start();
$title = 'login';
$style = 'css/style.css';
// include function
include 'functions.php';



if (!isset($_GET['loginAs']) AND !isset($_POST['login'])){
	header("Location: index.php");
	exit();
}elseif(isset($_GET['loginAs'])) {
	$loginAs = $_GET['loginAs'];
}

// ketika tombol login diklik maka lakukan validasi
if (isset($_POST['login'])){
	// validasi kosong, dll
	$username = $_POST['username'];
	$password = $_POST['password'];
	$loginAs = $_POST['loginAs'];
	
	// check apakah sama dengan data yang ada di database
	if(checkLogin($username, $password, $loginAs)){
		$_SESSION[$loginAs] = true;
		if ($loginAs == 'customer'){
			header("Location: customer/index.php?username=$username");
			exit();
		}else {
			header("Location: admin/index.php");
			exit();
		}
		
	}
}
include 'include/header.php';
include 'include/nav_pengunjung.php';

?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<input type="hidden" name="loginAs" value="<?php echo $loginAs ?>"><br><br>
		<label for="username">username</label>
		<input type="text" name="username" id="username"><br><br>
		<label for="password">password</label>
		<input type="password" name="password" id="password"><br><br>
		<button type="submit" name="login" value="login">login</button>
	</form>
<?php include 'include/footer.php' ?>