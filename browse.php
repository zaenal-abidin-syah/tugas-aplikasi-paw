<?php 
session_start();
$title = 'browse';
include 'functions.php';
include 'include/header.php';
?>
<?php $data = tampilData('customer') ?>
<a href="add.php">Tambah data</a>
<table>
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
			<a href="detail.php?username=<?php echo $value['username'] ?>">Detail</a>
			<a href="edit.php?username=<?php echo $value['username'] ?>">Edit</a>
			<a href="delete.php?username=<?php echo $value['username'] ?>">Delete</a>
		</td>
	</tr>
<?php endforeach ?>
</table>

<?php include 'include/footer.php'; ?>