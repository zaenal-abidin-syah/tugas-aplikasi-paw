<?php 
session_start();
$title = 'detail';
include 'functions.php';
include 'include/header.php';
?>

<a href="add.php">Tambah data</a>
<table>
<?php $data = tampilDetail($_GET['username']) ?>
	<h3>Profil</h3>
<?php foreach ($data as $value): ?>
	<p>Username : <?php echo $value['username'] ?></p>
	<p>Password : <?php echo $value['password'] ?></p>
<?php endforeach ?>
</table>

<?php include 'include/footer.php'; ?>