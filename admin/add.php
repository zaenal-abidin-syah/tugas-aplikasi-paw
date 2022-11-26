<?php 
session_start();
ob_start();
$title = 'register';
$style = '../css/style.css';
include '../functions.php';

if (!isset($_SESSION['admin'])){
	header('Location: ../index.php');
	exit();
}

if (isset($_POST['submit'])){
	$rekening = check_input($_POST['rekening']);
	$saldo = check_input($_POST['saldo']);
	$username = $_POST['username'];
	$errors = array();
	$rekeningError = cekRekening($rekening);
	$errors['rekeningError'] = $rekeningError;

	$saldoError = cekSaldo($saldo);
	$errors['saldoError'] = $saldoError;

	$err = false;
	foreach ($errors as $error) {
		
		if ($error != ''){
			$err = true;
		}
	}
    if (!$err){
    	insertRekening($username, $rekening, $saldo);
    	header("Location: index.php");
    	exit();
    }

}
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<input 
		type="hidden" 
		id="username"
		name="username"
		value="<?php echo isset($_POST['username']) ? $_POST['username'] : $_GET['username'] ?>"><br><br>
	<label for="rekening">rekening</label>
	<input 
		type="text"
		name="rekening" 
		id="rekening"
		value="<?php echo isset($_POST['rekening']) ? $_POST['rekening'] : '' ?>"><br><br>

	<label for="saldo">saldo</label>
	<input 
		type="text"
		name="saldo" 
		id="saldo"
		value="<?php echo isset($_POST['saldo']) ? $_POST['saldo'] : '' ?>"><br><br>
	<button type="submit" value="submit" name="submit">Tambah</button>
</form>