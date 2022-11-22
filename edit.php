<?php
session_start();
ob_start();
$title = 'edit';
include 'functions.php'; 
if (!isset($_GET['username'])){
	header('Location:index.php');
	exit();
}
$data = select($_GET['username'])[0];

include 'include/header.php';
include 'include/form.php';
include 'include/footer.php';

?>