<?php 
session_start(); 
ob_start();
if (!isset($_SESSION['customer'])){
	header('Location: ../index.php');
	exit();
}

if (isset($_GET['username'])){
	$username = $_GET['username'];
}

include '../functions.php';
$title = 'daftar rekening';
$style = '../css/style.css';
$no_rekening = tampilRekening($username);
include '../include/header.php';
include '../include/nav_customer.php'; 
?>

<div class="tombol">
	<a class="button button-yellow" href="edit.php?username=<?php echo $username; ?>">Edit Profil</a>
</div>


<table>
	<tr>
		<th>NO Rekening</th>
		<th>Saldo</th>
		<th></th>
	</tr>
	<?php foreach ($no_rekening as $rek): ?>
		<tr>
			<td>
				<?php echo $rek['no_rekening'] ?>
			</td>
			<td><?php echo $rek['saldo'] ?></td>
			<td>
				<a class="button button-blue" href="transaksi.php?no_rekening=<?php echo $rek['no_rekening'] ?>">browse</a>
				<a class="button button-green" href="transfer.php?no_rekening=<?php echo $rek['no_rekening'] ?>">Transfer</a>
			</td>
		</tr>
	<?php endforeach ?>
</table>


<?php include '../include/footer.php'; ?>