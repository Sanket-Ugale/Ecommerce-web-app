<?php
// session_start();
// if(!isset($_SESSION['logged_in'])){
// 	header('location:login.php');
// 	die();
// }
// elseif(!isset($_SESSION['order_process_no'])){
// 	header('location:cart2.php');
// 	die();
// }?>
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
            text-align: center; 
            background-color: #63d471;
            background-image: linear-gradient(315deg, #63d471 0%, #233329 74%);
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
            font-size:30px; 
            margin-top: 90%;
        }
        .message2{
            padding: 30px;
            color: rgb(255, 255, 255);
            font-size:20px; 
            margin-top: 90%;
        }
        .SendEmailButton{
            padding: 20px;
            font-family: 'Times New Roman', Times, serif;
            font-size: larger;
            font-weight: bold;
            border: 3px solid green;
            color: black;
            border-radius: 9px;
            cursor: pointer;
            background-color: none;
            border-color: #63d471;
        }
        .SendEmailButton:hover{
            transition-duration: 1s;
            background-color: green;
        }
        .goBackButton{
            margin-top: 30px;
            padding: 10px;
            font-family: 'Times New Roman', Times, serif;
            font-size: larger;
            font-weight: bold;
            border: 2px solid green;
            color: black;
            border-radius: 9px;
            cursor: pointer;
            background-color: none;
        }
    .goBackButton:hover{
        transition-duration: 1s;
            background-color: darkgreen;
    }
    </style> 

<?php
include 'conn.php';
include('smtp/PHPMailerAutoload.php');
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

if (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
        
            echo "<div><span class='message'>Invalid Transaction. Please try again</span> <br>";
      } else {
        $orderProcessId=$_SESSION['order_process_no'];
      echo "<span class='message'>Thank You. Your order status is <strong>". $status .".</strong></span><br>";
      echo "<span class='message2'>Your Transaction ID for this transaction is<strong> ".$txnid.".</strong></span><br>";
      echo "<span class='message2'>We have received a payment of Rs.<strong>" . $amount . ". </strong><br>Your order will soon be shipped.</span><br></div>";
      $mailHtml1="
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <table class='main' style='padding: 25px;
      background-color: rgb(0, 61, 63);
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 90%;
      margin-left: 3%;
      margin-right: 4%;
      text-align: center;
      color: white;
      font-family:Arial, Helvetica, sans-serif;'>
          <tr>
              <td colspan='4'>
                  <div class='title' style='text-align: center;
                  font-size: x-large;
                  font-weight:900;'>
                      Noble Intermediates Private Limited
                  </div>
              </td>
          </tr>
          <tr>
              <td colspan='4'>
                  <div class='title' style='text-align: left;
                  font-size: large;
                  font-weight:900;'>
                      Invoice id:".$orderProcessId."
                  </div>
              </td>
          </tr>
          <tr>
              <td class='date' colspan='4' style='text-align: right;
              padding-top: 10px;
              padding-bottom: 20px;'>
                  Date: ".date('l d-m-Y  h:i:sa')."
              </td>
          </tr>
          <tr class='one' style='padding-top: 20px;'>
              <th style='padding: 10px;
              border-top: 1px solid white;
              border-bottom: 1px solid white;'>
                  Name
              </th>
              <th style='padding: 10px;
              border-top: 1px solid white;
              border-bottom: 1px solid white;'>
                  Purchased Details
              </th>
              <th style='padding: 10px;
              border-top: 1px solid white;
              border-bottom: 1px solid white;'>
                  Final Amount
              </th>
          </tr>
          <tr class='two'>
              <td class='selcted' style='padding: 5px;'>
                  '$firstname'
              </td>
              <td class='selcted' style='padding: 5px;'>
                  '$productinfo'
              </td>
              <td class='selcted' style='padding: 5px;'>
                  '$amount'
              </td>
          </tr>
          <tr>
              <td style=' border-top: 1px dotted white;
              padding-top: 10px;' colspan='4'>
                  Get in touch with us on
              </td>
          </tr>
          <tr style='text-align: center;
          float: left;
          padding-top: 10px;
          letter-spacing: 15px;
          cursor: pointer;'>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/facebook.png' alt='facebook' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/twitter.png' alt='twitter' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/whatsapp.png' alt='whatsapp' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/linkedin.png' alt='linkedin' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/instagram.png' alt='instagram' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <a href='https://nobleintermediates.000webhostapp.com'></a><img src='https://nobleintermediates.000webhostapp.com/images/icons/website.png' alt='website' style='width: 30px; height: 30px;'>
              </td>
          </tr>
      </table>";




      $mailHtml2="
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <table class='main' style='padding: 25px;
      background-color: rgb(0, 61, 63);
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      transition: 0.3s;
      width: 90%;
      margin-left: 3%;
      margin-right: 4%;
      text-align: center;
      color: white;
      font-family:Arial, Helvetica, sans-serif;'>
          <tr>
              <td colspan='4'>
                  <div class='title' style='text-align: center;
                  font-size: x-large;
                  font-weight:900;'>
                      Noble Intermediates PVT LTD (New Order/Payment)
                  </div>
              </td>
          </tr>
          <tr>
              <td colspan='4'>
                  <div class='title' style='text-align: left;
                  font-size: large;
                  font-weight:900;'>
                  Invoice id:".$orderProcessId."
                  </div>
              </td>
          </tr>
          <tr>
              <td class='date' colspan='4' style='text-align: right;
              padding-top: 10px;
              padding-bottom: 20px;'>
                  Date: ".date('l d-m-Y  h:i:sa')."
              </td>
          </tr>
          <tr class='one' style='padding-top: 20px;'>
              <th style='padding: 10px;
              border-top: 1px solid white;
              border-bottom: 1px solid white;'>
                  Name
              </th>
              <th style='padding: 10px;
              border-top: 1px solid white;
              border-bottom: 1px solid white;'>
                  Purchased Details
              </th>
              <th style='padding: 10px;
              border-top: 1px solid white;
              border-bottom: 1px solid white;'>
                  Final Amount
              </th>
          </tr>
          <tr class='two'>
              <td class='selcted' style='padding: 5px;'>
                  '$firstname'
              </td>
              <td class='selcted' style='padding: 5px;'>
                  '$productinfo'
              </td>
              <td class='selcted' style='padding: 5px;'>
                  '$amount'
              </td>
          </tr>
          <tr>
              <td style=' border-top: 1px dotted white;
              padding-top: 10px;' colspan='4'>
                  Get in touch with us on
              </td>
          </tr>
          <tr style='text-align: center;
          float: left;
          padding-top: 10px;
          letter-spacing: 15px;
          cursor: pointer;'>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/facebook.png' alt='facebook' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/twitter.png' alt='twitter' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/whatsapp.png' alt='whatsapp' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/linkedin.png' alt='linkedin' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <img src='https://nobleintermediates.000webhostapp.com/images/icons/instagram.png' alt='instagram' style='width: 30px; height: 30px;'>
              </td>
              <td>
                  <a href='https://nobleintermediates.000webhostapp.com'></a><img src='https://nobleintermediates.000webhostapp.com/images/icons/website.png' alt='website' style='width: 30px; height: 30px;'>
              </td>
          </tr>
      </table>";

      $email2="";
      $message2= "Noble Intermiediates Private  Limited (Order/Payment) ";
      $message1= "Noble Intermiediates Private  Limited (Invoice)";
      smtp_mailer($email, $message1, $mailHtml1);
      smtp_mailer($email2, $message2, $mailHtml2);
      
    //echo " amount_paid= ".$amount.", transaction_id= ".$txnid." transaction_status= ".$status." order_process_id= ".$orderProcessId."<br>".$email."<br>".$firstname." ";
      mysqli_query($mysqli,"UPDATE orders SET amount_paid='$amount', transaction_id='$txnid', transaction_status='$status' WHERE order_process_id='$orderProcessId'");
    
      function smtp_mailer($to, $subject,$msg){
        $mail = new PHPMailer(); 
        $mail->SMTPDebug  = 0;
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = "";
        $mail->Password = "";
        $mail->SetFrom("");
        $mail->Subject = $subject;
        $mail->Body =$msg;
        $mail->AddAddress($to);
        // $mail->SMTPOptions=array('ssl'=>array(
        //   'verify_peer'=>false,
        //   'verify_peer_name'=>false,
        //   'allow_self_signed'=>false
        // ));
        if(!$mail->Send()){
            echo "<script>alert('not send');</script>";
        }else{
          return 'Sent';
        }
      } 
    
    }
    // smtp_mailer($email1, $message1, $mailHtml1);
    // smtp_mailer($email2, $message2, $mailHtml2);
    
     



     
      $mysqli->close();
    //   unset($_SESSION['order_process_no']);
     
      ?>	
      <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>
