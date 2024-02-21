<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
	header('location:login.php');
	die();
}
require('conn.php');
$productName=mysqli_real_escape_string($mysqli,$_POST['productName']);
$productName=str_replace('_',' ',$productName);
$query = mysqli_query($mysqli,"DELETE FROM product WHERE product_name='$productName'"); 
$query2=mysqli_query($mysqli,"SELECT product_image FROM product WHERE product_name='$productName'");
// echo $productName;
// echo $query;
// echo $query2;

while ($row = mysqli_fetch_assoc($query2)) {
    $image=$row['product_image'];
    var_dump($image);
    // unlink($image);
    if (file_exists($image)) {
        chmod($image, 0644);
        unlink($image);
        echo 'Deleted old image';
    } 
    else {
        echo 'Image file does not exist';
    }
}
header("Location: productsInfo.php"); 
?>