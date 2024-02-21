<?php
session_start();
if(!isset($_SESSION['logged_in'])){
	header('location:login.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Intermediates Private Limited</title>
    <link rel="icon" type="image/png" href="logo3.png">
</head>
<body>
    <style>
        body{
            text-align: center; background-color: #a40606;
            background-image: linear-gradient(315deg, #a40606 0%, #d98324 74%);
            background-repeat: no-repeat;
            height: 600px; 
            width: 100%; 
            margin-top: 70px;
            color: white;
        }
        div{
            background-color: rgb(0, 0, 0, 0.8);
            padding: 60px;
        }
        .message{
            padding: 30px;
            color: rgb(255, 255, 255);
            font-size:50px; 
            margin-top: 90%;
        }
        .message2{
            padding: 30px;
            color: rgb(255, 255, 255);
            font-size:30px; 
            margin-top: 90%;
        }
        .message3{
            padding: 30px;
            color: rgb(255, 255, 255);
            font-size:30px; 
            margin-top: 90%;
        }
    </style>
<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];

$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
  
       if ($hash != $posted_hash) {
            echo "<span class='message'>Invalid Transaction. Please try again</span> ";
      } 
      else 
      {
        echo "<div><br><span class='message2'>Your order status is <strong> ". $status .".</strong></span>";
        echo "<br><span class='message3'>Your transaction id for this transaction is <strong>".$txnid.".</strong> <br> You may try making the payment by clicking the link below.</span></div>";
        include 'conn.php';
        $orderProcessId=$_SESSION['order_process_no'];
        // echo " amount_paid= ".$amount.", transaction_id= ".$txnid." transaction_status= ".$status." order_process_id= ".$orderProcessId."<br>".$email."<br>".$firstname." ";
        mysqli_query($mysqli,"UPDATE orders SET transaction_id='$txnid', transaction_status='$status' WHERE order_process_id='$orderProcessId'");
        
        // unset($_SESSION['order_process_no']);   
    } 
    $mysqli->close(); 
?>
<style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>