<?php
session_start();
ob_start();
include '../functions.php';
deleteCustomer($_GET['username']);
header("Location:browse.php");
exit();
?>