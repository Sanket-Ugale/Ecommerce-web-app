<?php
$mysqli = new mysqli("localhost","root","","");

// Check connection
if ($mysqli -> connect_errno) {
  // echo '<script>alert("Failed to connect to Database")</script>';
  echo "<script>window.location.href='failed.php';</script>";
}
else{
    // echo "Success";
}
?>