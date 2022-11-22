<?php 
$dbc = new PDO('mysql:host=localhost;dbname=banking', 'root', '');

function checkLogin($username, $password, $loginAs){
	global $dbc;
	$statement = $dbc->prepare("
		SELECT * FROM $loginAs
		WHERE username = :username
		AND password = SHA2(:password, 0)
	");
	$statement->bindValue(':username', $username);
	$statement->bindValue(':password', $password);
	$statement->execute();
	return $statement->rowCount() > 0;
}

function tampilData($user){
	global $dbc;
	$statement = $dbc->prepare("
		SELECT * FROM $user
		");
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function tampilDetail($username)
{
	global $dbc;
	$statement = $dbc->prepare("
		SELECT * FROM customer WHERE username = :username
		");
	$statement->bindValue(':username', $username);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function select($username)
{
	global $dbc;
	$statement = $dbc->prepare("
		SELECT * FROM customer
		WHERE username = :username
	");
	$statement->bindValue(':username', $username);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function edit($username, $password){
	global $dbc;
	$statement = $dbc -> prepare("
			UPDATE customer(username, password) 
			SET ('coba4', SHA2(:password, 0))
			WHERE username = :username AND password = :password
		");
	$statement -> bindValue(':username', $username);
	$statement -> bindValue(':password', $password);
	$statement -> execute();
	// belum selesai
}

function deleteCustomer($username){
	// delete data customer
	global $dbc;
	$statement = $dbc -> prepare("
			DELETE FROM customer WHERE username = :username
		");
	$statement -> bindValue(':username', $username);
	$statement -> execute();
}

function register($username, $password){
	// mendaftarkan akun customer
}

function transfer(){
	// transfer antar customer
}

function tampilProfil(){
	// menampilkan profil customer
}
?>

	

