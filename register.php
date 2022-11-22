<?php 
session_start();
$title = 'register';
include 'functions.php';
include 'include/header.php';
?>

<a href="add.php">Tambah data</a>
<table>
<?php $data = tampilData('pendaftar') ?>
	<tr>
		<th>Username</th>
		<th>Password</th>
		<th></th>
	</tr>
<?php foreach ($data as $value): ?>
	<tr>
		<td><?php echo $value['username'] ?></td>
		<td><?php echo $value['password'] ?></td>
		<td>
			<a href="action/add.php?username=<?php echo $value['username'] ?>">Terima</a>
			<a href="action/delete.php?username=<?php echo $value['username'] ?>">Tolak</a>
		</td>
	</tr>
<?php endforeach ?>
</table>

<?php include 'include/footer.php'; ?>