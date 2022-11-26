<?php 
session_start();
ob_start();
include '../functions.php';
if (!isset($_SESSION['customer'])){
	header('Location: ../index.php');
	exit();
}
$style = '../css/style5.css';
$title = 'transfer';

if (isset($_POST['submit'])){
	$rekeningPengirim = check_input($_POST['rekening_pengirim']);
	$rekeningPenerima = check_input($_POST['rekening_penerima']);
	$jumlahTransaksi = check_input($_POST['jumlah_transaksi']);
	$tf = transfer($rekeningPengirim, $rekeningPenerima, $jumlahTransaksi);
	if(!$tf){
		echo "transaksi gagal";
	}else{
		echo $tf;
	}
}


include '../include/header.php';
include '../include/nav_customer.php'; 
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
	<input 
		type="hidden"
		name="rekening_pengirim"
		value="<?php echo isset($_POST['rekening_pengirim']) ? $_POST['rekening_pengirim'] : $_GET['no_rekening'] ?>"><br><br>
	<label for="rekening_penerima">rekening_penerima</label>
	<input 
		type="text"
		name="rekening_penerima" 
		id="rekening_penerima"
		value="<?php echo isset($_POST['rekening_penerima']) ? $_POST['rekening_penerima'] : '' ?>"><br><br>
	<label for="jumlah_transaksi">jumlah_transaksi</label>
	<input 
		type="text"
		name="jumlah_transaksi" 
		id="jumlah_transaksi"
		value="<?php echo isset($_POST['jumlah_transaksi']) ? $_POST['jumlah_transaksi'] : '' ?>"><br><br>
	<button type="submit" value="submit" name="submit">Tambah</button>
</form>

<?php include '../include/footer.php'; ?>