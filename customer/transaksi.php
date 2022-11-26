<?php 
session_start();
ob_start();
$title = 'transaksi';
$style = '../css/style5.css';
include '../functions.php';
if (!isset($_SESSION['customer'])){
	header('Location: ../index.php');
	exit();
}

$datakirim = tampilDataTransaksiPengiriman($_GET['no_rekening']);
$dataTerima = tampilDataTransaksiPenerimaan($_GET['no_rekening']);
$user = tampiluser($_GET['no_rekening'])[0];
// var_dump($datakirim);
include '../include/header.php';
include '../include/nav_customer.php';
?>

<h3>Transaksi Pengiriman</h3>
<table>
	<tr>
		<th>Rekening Pengirim</th>
		<th>Rekening Penerima</th>
		<th>jumlah transaksi</th>
		<th>tanggal</th>
	</tr>
	<?php foreach ($datakirim as $data): ?>
		<tr>
			<td>
				<?php echo $data['rekening_pengirim'] ?>
				
			</td>
			<td>
				<?php echo $data['rekening_penerima'] ?>
			</td>
			<td>
				<?php echo $data['jumlah_transaksi'] ?>
			</td>
			<td>
				<?php echo $data['tanggal'] ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>

<h3>Transaksi Penerimaan</h3>
<table>
	<tr>
		<th>Rekening Pengirim</th>
		<th>Rekening Penerima</th>
		<th>jumlah transaksi</th>
		<th>tanggal</th>
	</tr>
	<?php foreach ($dataTerima as $data): ?>
		<tr>
			<td>
				<?php echo $data['rekening_pengirim'] ?>
				
			</td>
			<td>
				<?php echo $data['rekening_penerima'] ?>
			</td>
			<td>
				<?php echo $data['jumlah_transaksi'] ?>
			</td>
			<td>
				<?php echo $data['tanggal'] ?>
			</td>
		</tr>
	<?php endforeach ?>
</table>
<div class="tombol">
	<a class="button button-red" href="index.php?username=<?php echo $user['username'] ?>">Kembali</a>
</div>
<?php include '../include/footer.php'; ?>