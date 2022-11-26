<?php 
session_start();
$title = 'browse';
$style = '../css/style5.css';
if (!isset($_SESSION['admin'])){
	header('Location:index.php');
	exit();
}
include '../functions.php';
$data = tampilData();
include '../include/header.php';
include '../include/nav_admin.php';
?>
<table>
	<tr>
		<th>Username</th>
		<th></th>
	</tr>
<?php foreach ($data as $value): ?>
	<tr>
		<td><?php echo $value['username'] ?></td>
		<td>
			<a class="button button-green" href="detail.php?username=<?php echo $value['username'] ?>">Detail</a>
			<a class="button button-blue" href="edit.php?username=<?php echo $value['username'] ?>">Edit</a>
			<a class="button button-red" href="delete.php?username=<?php echo $value['username'] ?>">Delete</a>
		</td>
	</tr>
<?php endforeach ?>
</table>

<?php include '../include/footer.php'; ?>