<?php 
session_start();
unset($_SESSION['admin']);
unset($_SESSION['customer']);
$sesi = $_SERVER['HTTP_HOST'];
header("Location: http://$sesi/tugas-aplikasi/index.php");
exit();
?>