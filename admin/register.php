<?php 
session_start();
ob_start();
$title = 'register';
$style = '../css/style5.css';
include '../functions.php';

if (!isset($_SESSION['admin'])){
	header('Location: ../index.php');
	exit();
}

if (isset($_POST['submit'])){
	$username = check_input($_POST['username']);
	$password = check_input($_POST['password']);
	$rekening = check_input($_POST['rekening']);
	$saldo = check_input($_POST['saldo']);
	$nama = check_input($_POST['nama']);
	$email = check_input($_POST['email']);
	$no_tlp = check_input($_POST['no_tlp']);
	$alamat = check_input($_POST['alamat']);
	$errors = array();

    $usernameError = cekUsername($username);
	$errors['usernameError'] = $usernameError;

	$passwordError = cekPassword($password);
	$errors['passwordError'] = $passwordError;

	$rekeningError = cekRekening($rekening);
	$errors['rekeningError'] = $rekeningError;

	$saldoError = cekSaldo($saldo);
	$errors['saldoError'] = $saldoError;

    $nameError = cekName($nama);
	$errors['nameError'] = $nameError;

	$emailError = cekEmail($email);
	$errors['emailError'] = $emailError;

	$no_tlpError = cekNo_tlp($no_tlp);
	$errors['no_tlpError'] = $no_tlpError;

	$alamatError = cekAlamat($alamat);
	$errors['alamatError'] = $alamatError;
	$err = false;
	foreach ($errors as $error) {
		
		if ($error != ''){
			$err = true;
		}
	}
    if (!$err){
        insertUser($username, $password);
    	insertProfil($username, $nama, $email, $no_tlp, $alamat);
    	insertRekening($username, $rekening, $saldo);
    	header("Location: index.php");
    	exit();
    }	
}

include '../include/header.php';
include '../include/nav_admin.php';
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="username">Username</label>
	<input 
		type="text"
		name="username" 
		id="username"
		value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"><br><br>
	<label for="password">password</label>
	<input 
		type="text"
		name="password" 
		id="password"
		value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"><br><br>
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
	<label for="nama">Nama</label>
	<input 
		type="text"
		name="nama" 
		id="nama"
		value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : '' ?>"><br><br>
	<label for="email">email</label>
	<input 
		type="text"
		name="email" 
		id="email"
		value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"><br><br>
	<label for="no_tlp">No. Telephone</label>
	<input 
		type="text"
		name="no_tlp" 
		id="no_tlp"
		value="<?php echo isset($_POST['no_tlp']) ? $_POST['no_tlp'] : '' ?>"><br><br>
	<label for="alamat">alamat</label>
	<textarea 
		name="alamat" id="alamat"><?php echo isset($_POST['alamat']) ? $_POST['alamat'] : '' ?></textarea>
	<br><br>
	<button type="submit" name="submit">Submit</button>
</form>
<?php include '../include/footer.php'; ?>