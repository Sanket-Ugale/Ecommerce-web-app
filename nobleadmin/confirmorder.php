<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
	header('location:login.php');
	die();
}
require('conn.php');
$confirmed="confirmed";
$orderId=mysqli_real_escape_string($mysqli,$_POST['order_process_id']);
$query = mysqli_query($mysqli,"UPDATE orders SET confirmation_status='$confirmed' WHERE order_process_id='$orderId'"); 
header("Location: orders.php"); 
?>