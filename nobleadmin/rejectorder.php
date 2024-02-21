<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
	header('location:login.php');
	die();
}
require('conn.php');
$rejected="rejected";
$orderId=mysqli_real_escape_string($mysqli,$_POST['order_processid']);
$query = mysqli_query($mysqli,"UPDATE orders SET confirmation_status='$rejected' WHERE order_process_id='$orderId'"); 
header("Location: orders.php"); 
?>