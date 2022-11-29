<?php 
// mengkoneksikan ke database
$dbc = new PDO('mysql:host=localhost;dbname=banking', 'root', '');

// function untuk login
function checkLogin($username, $password, $loginAs){
	global $dbc;

	// jika login sebagai admin dan mengecek ke dalam database dengan role 1
	if ($loginAs == 'admin'){
		$statement = $dbc->prepare("
		SELECT * FROM user
		WHERE username = :username
		AND password = SHA2(:password, 0) AND role = 1
	");
	}
	// jika login sebagai customer dan mengecek ke dalam database dengan role 0
	elseif($loginAs == 'customer'){
		$statement = $dbc->prepare("
		SELECT * FROM user
		WHERE username = :username
		AND password = SHA2(:password, 0) AND role = 0
	");
	}
	
	$statement->bindValue(':username', $username);
	$statement->bindValue(':password', $password);
	$statement->execute();
	return $statement->rowCount() > 0;
}

// menampilkan data customer dengan mengecek user dengan role 0
function tampilData(){
	global $dbc;
	$statement = $dbc->prepare("
		SELECT username FROM user WHERE role = 0
		");
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}
// menampilkan detail dari suatu customer yang di tunjuk
function tampilDetail($username)
{
	global $dbc;
	// melakukan inner join antara user dan profil
	$statement = $dbc->prepare("
		SELECT * FROM user 
		JOIN profil ON (user.username = profil.username) 
		WHERE user.username = :username
		");
	$statement->bindValue(':username', $username);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function tampilUser($no_rekening)
{
	global $dbc;
	// melakukan inner join antara user dan profil
	$statement = $dbc->prepare("
		SELECT username FROM rekening
		WHERE no_rekening = :no_rekening
		");
	$statement->bindValue(':no_rekening', $no_rekening);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

// menampilkan rekening rekening yang di miliki oleh customer
function tampilRekening($username)
{
	global $dbc;
	// melakukan join antara user dan rekening
	$statement = $dbc->prepare("
		SELECT rekening.no_rekening AS no_rekening,
			rekening.saldo AS saldo
		FROM user 
		JOIN rekening ON (user.username = rekening.username) 
		WHERE user.username = :username 
		");
	$statement->bindValue(':username', $username);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function tampilDataTransaksiPengiriman($no_rekening)
{
	global $dbc;
	// melakukan join antara user dan rekening
	$statement = $dbc->prepare("
		SELECT transaksi.rekening_pengirim, transaksi.rekening_penerima, transaksi.jumlah_transaksi, transaksi.tanggal 
		FROM rekening 
		JOIN transaksi ON (rekening.no_rekening = transaksi.rekening_pengirim) 
		WHERE rekening.no_rekening = :no_rekening 
		");
	$statement->bindValue(':no_rekening', $no_rekening);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function tampilDataTransaksiPenerimaan($no_rekening)
{
	global $dbc;
	// melakukan join antara user dan rekening
	$statement = $dbc->prepare("
		SELECT transaksi.rekening_pengirim, transaksi.rekening_penerima, transaksi.jumlah_transaksi, transaksi.tanggal 
		FROM rekening 
		JOIN transaksi ON (rekening.no_rekening = transaksi.rekening_penerima) 
		WHERE rekening.no_rekening = :no_rekening
		");
	$statement->bindValue(':no_rekening', $no_rekening);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

// data profil terkait user seperti username nama email dll
function select($username)
{
	global $dbc;
	// melakukan join antara user dan profil
	$statement = $dbc->prepare("
		SELECT user.username AS username,
		profil.nama AS nama,
		profil.email AS email,
		profil.no_tlp AS no_tlp,
		profil.alamat AS alamat 
		FROM user
		JOIN profil ON (user.username = profil.username)
		WHERE user.username = :username
	");
	$statement->bindValue(':username', $username);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}


// menghapus data customer
function deleteCustomer($username){
	// delete data customer
	global $dbc;
	$statement = $dbc -> prepare("
			DELETE FROM user
			WHERE username = :username
		");
	$statement -> bindValue(':username', $username);
	$statement -> execute();
}

// update atau edit profil   yang dimiliki oleh user/ customer
function updateProfil($username, $nama, $email, $no_tlp, $alamat)
{
	global $dbc;
	$statement = $dbc -> prepare("
			UPDATE profil
			SET nama = :nama, 
				email = :email,
				no_tlp = :no_tlp,
				alamat = :alamat 
			WHERE username = :username 
		");
	$statement -> bindValue(':nama', $nama);
	$statement -> bindValue(':email', $email);
	$statement -> bindValue(':no_tlp', $no_tlp);
	$statement -> bindValue(':alamat', $alamat);
	$statement -> bindValue(':username', $username);
	$statement -> execute();
}
// edit atau update username dasri user jika username berganti
function updateUsername($usernameLama, $username)
{
	global $dbc;
	$statement = $dbc -> prepare("
			UPDATE user
			SET username = :username
			WHERE username = :usernameLama 
		");
	$statement -> bindValue(':username', $username);
	$statement -> bindValue(':usernameLama', $usernameLama);
	$statement -> execute();
}

// mengamankan data yang diinputkan
function check_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

// cek inputan nama
function cekName($data)
{
	// validasi jika kosong
	if (empty($data)){
		return "Nama lengkap tidak boleh kosong!";
	}
	// validasi kecocokan
	if(!preg_match("/^[a-zA-Z ]+$/", $data)){
		return "Nama lengkap tidak Valid, Hanya boleh berupa karakter alfabet";
	}
	// validasi panjang karakter
	if(strlen($data)>30){
		return "Nama lengkap tidak boleh lebih dari 30 karakter";
	}

	return "";
}

// cek inputan username
function cekUsername($data){
	// validasi jika kosong
	if (empty($data)){
		return "Username tidak boleh kosong!";
	}
	// valisasi regex
	if(!preg_match("/^[a-zA-Z0-9]+$/", $data)){
		return "Username tidak Valid, Hanya boleh berupa karakter alfanumerik";
	}
	// validasi panjang karakter
	if(strlen($data)>10){
		return "Username tidak boleh lebih dari 10 karakter";
	}

	return "";
}

// cek inputan email
function cekEmail($data){
	// validasi kosong
	if (empty($data)){
		return "email tidak boleh kosong!";
	}
	// validasi regex
	if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9]{2,3}$/", $data)){
		return "email tidak Valid";
	}
	return "";
}

// cek inputan no tlp
function cekNo_tlp($data){
	// validasi kosong
	if (empty($data)){
		return "no Handphone tidak boleh kosong!";
	}
	// validasi regex
	if(!preg_match("/^(08|\+62)[0-9]+$/", $data)){
		return "no Handphone tidak Valid, Hanya boleh berupa karakter numerik";
	}
	// validasi panjang karakter
	if(strlen($data)>13){
		return "no Handphone terlalu panjang, hanya boleh 12-13 digit";
	}
	if(strlen($data)<12){
		return "no Handphone terlalu pendek, hanya boleh 12-13 digit";
	}
	return "";
}

// cek inputan alamat
function cekAlamat($data)
{
	// validasi kosong
	if (empty($data)){
		return "Alamat tidak boleh kosong!";
	}
	// validasi panjang karakter
	if(strlen($data)>100){
		return "Alamat terlalu panjang, hanya boleh kurang dari 100 karakter";
	}
	return '';

}
// cek inputan password
function cekPassword($data)
{
	// validasi jika kosong
	if (empty($data)){
		return "password tidak boleh kosong!";
	}
	// valisasi regex
	if(!preg_match("/^[a-zA-Z0-9]+$/", $data)){
		return "password tidak Valid, Hanya boleh berupa karakter alfanumerik";
	}
	// validasi panjang karakter
	if(strlen($data)<8){
		return "password tidak boleh kurang dari 8 karakter";
	}

	return "";
}

//cek inputan rekening
function cekRekening($data)
{
	// validasi kosong
	if (empty($data)){
		return "rekening tidak boleh kosong!";
	}
	// validasi regex
	if(!preg_match("/^[0-9]+$/", $data)){
		return "rekening tidak Valid, Hanya boleh berupa karakter numerik";
	}
	// validasi panjang karakter
	if(strlen($data) != 10){
		return "rekening harus 10 karakter";
	}
	
	return "";
}

// cek saldo

function cekSaldo($data)
{
	// validasi kosong
	if (empty($data)){
		return "saldo tidak boleh kosong!";
	}
	// validasi regex
	if(!preg_match("/^[0-9]+$/", $data)){
		return "saldo tidak Valid, Hanya boleh berupa karakter numerik";
	}
	// validasi panjang karakter
	if($data < 50000){
		return "saldo minimal 50000";
	}
	
	return "";
}

// memasukan user
function insertUser($username, $password)
{
	global $dbc;
	
	$statement = $dbc->prepare("
		INSERT INTO user 
		VALUES (:username, SHA2(:password, 0), 0)
		");
	$statement->bindValue(':username', $username);
	$statement->bindValue(':password', $password);
	$statement->execute();
}

function insertProfil($username, $nama, $email, $no_tlp, $alamat)
{
	global $dbc;
	
	$statement = $dbc->prepare("
		INSERT INTO profil
		VALUES (:username, :nama, :no_tlp, :email, :alamat)
		");
	$statement->bindValue(':username', $username);
	$statement->bindValue(':nama', $nama);
	$statement->bindValue(':no_tlp', $no_tlp);
	$statement->bindValue(':email', $email);
	$statement->bindValue(':alamat', $alamat);
	$statement->execute();
}

// memasukan no rekening

function insertRekening($username, $rekening, $saldo)
{
	global $dbc;
	
	$statement = $dbc->prepare(" 
		INSERT INTO rekening
		VALUES (:rekening, :username, :saldo)
		");
	$statement->bindValue(':username', $username);
	$statement->bindValue(':rekening', $rekening);
	$statement->bindValue(':saldo', $saldo);
	$statement->execute();
}



function tampilSaldo($no_rekening)
{
	global $dbc;
	$statement = $dbc->prepare("
		SELECT saldo FROM rekening 
		WHERE no_rekening = :no_rekening
		");
	$statement->bindValue(':no_rekening',$no_rekening);
	$statement->execute();
	$data = [];
	
	foreach ($statement as $values) {
		$data[] = $values;	
	}
	return $data;
}

function updateRekeningPengirim($rekeningPengirim, $jumlahTransaksi){
	global $dbc;
	$statement = $dbc->prepare("
		UPDATE rekening
		SET saldo = saldo - :jumlah_transaksi 
		WHERE no_rekening = :no_rekening
		");
	$statement->bindValue(':jumlah_transaksi',$jumlahTransaksi);
	$statement->bindValue(':no_rekening',$rekeningPengirim);
	$statement->execute();
}

function updateRekeningPenerima($rekeningPenerima, $jumlahTransaksi){
	global $dbc;
	$statement = $dbc->prepare("
		UPDATE rekening
		SET saldo = saldo + :jumlah_transaksi 
		WHERE no_rekening = :no_rekening
		");
	$statement->bindValue(':jumlah_transaksi',$jumlahTransaksi);
	$statement->bindValue(':no_rekening',$rekeningPenerima);
	$statement->execute();
}

function insertTransaksi($rekeningPengirim, $rekeningPenerima, $jumlahTransaksi){
	global $dbc;
	$statement = $dbc->prepare("
		INSERT INTO transaksi (rekening_pengirim, rekening_penerima, jumlah_transaksi) 
		VALUES (:rekening_pengirim, :rekening_penerima, :jumlah_transaksi)
		");
	$statement->bindValue(':rekening_pengirim',$rekeningPengirim);
	$statement->bindValue(':rekening_penerima',$rekeningPenerima);
	$statement->bindValue(':jumlah_transaksi',$jumlahTransaksi);
	$statement->execute();
}

function transfer($rekeningPengirim, $rekeningPenerima, $jumlahTransaksi)
{
	// cek jumlah saldo
	$saldo = tampilSaldo($rekeningPengirim)[0]['saldo'];
	if ($saldo < $jumlahTransaksi){
		return false;
	}
	updateRekeningPengirim($rekeningPengirim, $jumlahTransaksi);
	updateRekeningPenerima($rekeningPenerima, $jumlahTransaksi);
	insertTransaksi($rekeningPengirim, $rekeningPenerima, $jumlahTransaksi);
	return 'transaksi berhasil';
}


?>

	

