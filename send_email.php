<?php
include('smtp/PHPMailerAutoload.php');
if(isset($_POST['subject']) && isset($_POST['message'])){
    // include('smtp/PHPMailerAutoload.php');
    // Include the necessary files
    require_once "conn.php";
    require_once "validate.php";
    $subject=validate($_POST['subject']);
    $message=validate($_POST['message']);
    $email="";

    // $result = mysqli_query($conn, "select * from recipient_data");
    //     if (mysqli_num_rows($result) > 0) {
    //         while($rows=mysqli_fetch_assoc($result))
    //         {
    //             $email=$rows["recipient_email"];
    //             // smtp_mailer($email, $subject, $message);
    //         }
    // }
    smtp_mailer($email, $subject, $message);
    
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
    $mail->Username = ""; // Your Email ID
    $mail->Password = ""; // Password
    $mail->SetFrom("");
    $mail->Subject = $subject;
    $mail->Body =$msg;
    $mail->AddAddress($to);
    if(!$mail->Send()){
        echo 'failure';
    }else{
        echo 'success';
    }
  } 
}
// else{
//     echo 'failure';
// }
?>