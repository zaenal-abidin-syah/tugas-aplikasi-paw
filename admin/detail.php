<?php 
session_start();
ob_start();
if (!isset($_SESSION['admin'])){
	header("Location: index.php");
	exit();
}
$title = 'detail';
$style = '../css/style5.css';
include '../functions.php';
$data = tampilDetail($_GET['username']);
$no_rekening = tampilRekening($_GET['username']);
include '../include/header.php';
include '../include/nav_admin.php';
?>

<table>
	<tr>
		<th>Nama</th>
		<th>Username</th>
		<th>Email</th>
		<th>NO Handphone</th>
		<th>Alamat</th>
		<th>No rekening</th>
	</tr>
<?php foreach ($data as $value): ?>
	<tr>
		<td><?php echo $value['nama'] ?></td>
		<td><?php echo $value['username'] ?></td>
		<td><?php echo $value['email'] ?></td>
		<td><?php echo $value['no_tlp'] ?></td>
		<td><?php echo $value['alamat'] ?></td>
		<td>
			<?php foreach ($no_rekening as $value): ?>
				<?php echo $value['no_rekening'] ?><br>
			<?php endforeach ?>
		</td>
	</tr>
	
<?php endforeach ?>
</table>
<div class="tombol">
	<a class="button button-green" href="add.php?username=<?php echo $_GET['username'] ?>">Tambah Rekening</a>
	<a class="button button-red" href="browse.php">Kembali</a>
</div>

<?php include '../include/footer.php'; ?>


