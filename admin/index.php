<?php 
session_start(); 
ob_start();
if (!isset($_SESSION['admin'])){
    header('Location: ../index.php');
    exit();
}
$title = 'Home';
$style = '../css/style.css';
include '../include/header.php';
include '../include/nav_admin.php';
 ?>

<!-- isi -->
<p>UTM Banking ada Suatu sistem aplikasi untuk universitas trunojoyo madura</p>

<?php include '../include/footer.php'; ?>
