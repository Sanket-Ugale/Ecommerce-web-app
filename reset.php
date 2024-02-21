<?php
include('smtp/PHPMailerAutoload.php');
include('conn.php');
$reset_id=mysqli_real_escape_string($mysqli,$_GET['id']);
$msg="";
$confirmPassword="";
$password="";
if(isset($_POST['submit'])){
	$password=mysqli_real_escape_string($mysqli,$_POST['password']);
    $confirmPassword=mysqli_real_escape_string($mysqli,$_POST['confirmPassword']);
	$check=mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM user WHERE reset_id='$reset_id' and reset_status=0"));

    if($password != $confirmPassword){
        $msg="password and Confirm Password not matched.";
    }
    elseif(strlen($password) <8){
        $msg="password must contain eight or more characters.";
    }
    elseif($check>0){
      $pass=password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($mysqli,"UPDATE user set password= '$pass', reset_status = 1 WHERE reset_id= '$reset_id'" );
        $msg= "Password Changed successfully <br> Go to <a href='https://nobleintermediates.000webhostapp.com/login.php'> Login</a>";

    }
    else{
           $msg="Sorry, Link expired"; 
    }
}
$mysqli -> close();
?>

<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/signupstyle.css">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="icon" type="image/png" href="images/logo3.png">
   </head>
<body>
  <div class="wrapper">
    <h2>Reset Password</h2>
    <form method="post">
      <div class="input-box">
        <input name="password" type="password" placeholder="Create password" required>
      </div>
      <div class="input-box">
        <input name="confirmPassword" type="password" placeholder="Confirm password" required>
      </div>
      <div class="input-box button">
        <input type="submit" name="submit" value="Reset">
      </div>
      <div class="message">
		<?php
		echo $msg;
		?>
		</div>
    </form>
  </div>
  <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>
