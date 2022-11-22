<?php 
session_start();
$title = 'browse';
$style = '../css/style1.css';
if (!isset($_SESSION['admin'])){
	header('Location:index.php');
	exit();
}
include '../functions.php';
$data = tampilData('customer');
include '../include/header.php';
include '../include/nav_admin.php';
include '../include/table_data.php';
include '../include/footer.php'; 
?>