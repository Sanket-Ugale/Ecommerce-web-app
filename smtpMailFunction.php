<?php
include('smtp/PHPMailerAutoload.php');
// class sendEmail{
    function smtp_mailer($to, $subject,$msg){
    $mail = new PHPMailer(); 
    $mail->SMTPDebug  = 0;
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "outlook.office365.com";
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
      echo '<script>alert("Error occured in Email Sending");</script>';
    }else{
      return 'Sent';
    }
  } 
// }
?>