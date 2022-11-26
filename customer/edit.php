<?php
session_start();
ob_start();
$title = 'edit';
$style = '../css/style.css';
include '../functions.php'; 
if (!isset($_SESSION['customer'])){
	header('Location: ../index.php');
	exit();
}
if (!isset($_GET['username']) AND !isset($_POST['submit'])){
	header('Location:index.php');
	exit();
}
if (isset($_POST['submit'])){
	$username = check_input($_POST['username']);
	$usernameLama = check_input($_POST['usernameLama']);
	$nama = check_input($_POST['nama']);
	$email = check_input($_POST['email']);
	$no_tlp = check_input($_POST['no_tlp']);
	$alamat = check_input($_POST['alamat']);
	$errors = array();

    $usernameError = cekUsername($username);
	$errors['usernameError'] = $usernameError;

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
    if ($err){
        $data = select($username)[0];
    }else{
    	updateProfil($username, $nama, $email, $no_tlp, $alamat);
    	if ($usernameLama == $username){
    		updateUsername($usernameLama, $username);
    	}
    	header("Location: index.php?username=$username");
    	exit();
    }
	
}
if (isset($_GET['username'])){
	$data = select($_GET['username'])[0];

}
include '../include/header.php';
include '../include/nav_customer.php';
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="usernameLama" value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>">
	<label for="username">Username</label>
	<input 
		type="text"
		name="username" 
		id="username"
		value="<?php echo isset($data['username']) ? $data['username'] : ''; ?>">
	<p class="warning">
		<?php echo isset($_POST['submit']) ? $errors['usernameError'] : '' ?>
	</p>
	<label for="nama">Nama</label>
	<input 
		type="text"
		name="nama" 
		id="nama"
		value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>">
	<p class="warning">
		<?php echo isset($_POST['submit']) ? $errors['nameError'] : '' ?>
	</p>
	<label for="email">email</label>
	<input 
		type="text"
		name="email" 
		id="email"
		value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>">
	<p class="warning">
		<?php echo isset($_POST['submit']) ? $errors['emailError'] : '' ?>
	</p>
	<label for="no_tlp">No. Telephone</label>
	<input 
		type="text"
		name="no_tlp" 
		id="no_tlp"
		value="<?php echo isset($data['no_tlp']) ? $data['no_tlp'] : ''; ?>">
	<p class="warning">
		<?php echo isset($_POST['submit']) ? $errors['no_tlpError'] : '' ?>
	</p>
	<label for="alamat">alamat</label>
	<textarea 
		name="alamat" id="alamat"><?php echo isset($data['alamat']) ? $data['alamat'] : ''; ?></textarea>
	<p class="warning">
		<?php echo isset($_POST['submit']) ? $errors['alamatError'] : '' ?>
	</p>
	<button type="submit" name="submit">Submit</button>
</form>
<?php include '../include/footer.php'; ?>