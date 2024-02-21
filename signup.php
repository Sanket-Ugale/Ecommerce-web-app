<?php
include('smtp/PHPMailerAutoload.php');
include('conn.php');
$msg="";
$confirmPassword="";
$password="";
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($mysqli,$_POST['username']);
	$email=mysqli_real_escape_string($mysqli,$_POST['email']);
	$password=mysqli_real_escape_string($mysqli,$_POST['password']);
  $confirmPassword=mysqli_real_escape_string($mysqli,$_POST['confirmPassword']);
	$check=mysqli_num_rows(mysqli_query($mysqli,"select * from user where email='$email'"));
  $check2=mysqli_num_rows(mysqli_query($mysqli,"select * from user where username='$name'"));
	
  if($check2>0){
		$msg="Username is not available please try to Sign Up with different Username.";
	}
  elseif ($email==$name) {
    $msg = "Username and Email can't be same."; 
  }
  elseif($check>0){
		$msg="Email id allready present";
	}
  elseif($password != $confirmPassword){
    $msg="password and Confirm Password not matched.";
  }
  elseif(strlen($password) <8){
    $msg="password must contain eight or more characters.";
  }
  else{
		$verification_id=rand(111111111,999999999);
    $pass=password_hash($password, PASSWORD_DEFAULT);
mysqli_query($mysqli,"INSERT into user(username,email,password,verification_status,verification_id) values('$name','$email','$pass',0,'$verification_id')");

		$msg="We've just sent a verification link to <strong>$email</strong>. Please check your inbox and click on the link to get started. If you can't find this email (which could be due to spam filters), just request a new one here.";
		
		$mailHtml="<body>

    <table style='padding: 25px;
    background-color: rgb(0, 61, 63);
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 90%;
    margin-left: 5%;
    text-align: center;
    color: white;
    font-family:Arial, Helvetica, sans-serif;'>
        <tr>
            <td colspan='4'>
                <div style='text-align: center;
                font-size: x-large;
                font-weight:900;'>
                    Noble Intermediates Private Limited
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <p class='paragraph' style='color:white'>Please confirm your account registration by clicking the button below:</p><p></p> <br>
                <a style='color: white;
                border-radius: 8px;
                text-decoration: none;
                background-color: rgb(255, 166, 1);
                padding: 10px;
                box-shadow: 2px 2px 2px 2px rgb(0, 0, 0); '' href='https://nobleintermediates.000webhostapp.com/check.php?id=$verification_id' 
                onmouseover='this.style.backgroundcolor= '#FF0000';
                this.style.padding= '12px';'
    
                onmouseout='this.style.backgroundColor='#FF2D00';
                this.style.padding= '10px';'
                >Verify account</a><br><br> <strong style='color:white'> or go to</strong><br> <br><a style='padding-top: 9px;
                text-decoration: none;
                color: white; 
                ' href='https://nobleintermediates.000webhostapp.com/check.php?id=$verification_id'>https://nobleintermediates.000webhostapp.com/check.php?id=$verification_id</a></p>
    
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
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/facebook.png' alt='facebook' style='width: 20px; height: 20px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/twitter.png' alt='twitter' style='width: 20px; height: 20px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/whatsapp.png' alt='whatsapp' style='width: 20px; height: 20px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/linkedin.png' alt='linkedin' style='width: 20px; height: 20px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/instagram.png' alt='instagram' style='width: 20px; height: 20px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/website.png' alt='website' style='width: 20px; height: 20px;'>
            </td>
        </tr>
    </table>
    </body>";
    $message= "Noble Intermiediates Private  Limited";
		smtp_mailer($email, $message, $mailHtml);
		
	}
}

// use PHPMailer\PHPMailer\PHPMailer;
//   use PHPMailer\PHPMailer\SMTP;
//   use PHPMailer\PHPMailer\Exception;

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
      echo '<script>alert("Error occured in Email Sending");</script>';
    }else{
      return 'Sent';
    }
  } 
  $mysqli -> close();
?>

<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/signupstyle.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="icon" type="image/png" href="images/logo3.png">
    <title>Noble Intermediates | Sign Up</title>
   </head>
   <?php
  session_start();
if(isset($_SESSION['logged_in'])){
    echo "<body onLoad='myfunction();'>
    <script>
        function myfunction(){
            document.getElementById('login').style.display = 'none';
            document.getElementById('signup').style.display = 'none';
            document.getElementById('logout').style.display = 'contents';
            
        }
    </script>";
}
if(!isset($_SESSION['logged_in'])){
    echo "<body onLoad='myfunction();'>
    <script>
        function myfunction(){
            document.getElementById('profile').style.display = 'none';            
        }
    </script>";
}
?>
<header>
    <a href="index.php"><img class="imageLogo" src="images/logo.png" alt="Noble Intermediates Private Limited"></a>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="menu-bar">
                <i class="fas fa-bars"></i>
              </label>

            <nav class="navbar">
                <ul>
                    <li><a href="products.php">Products <i class="fa-solid fa-chevron-down"></i></a>
                        <ul>
                        <?php
                            include 'conn.php';
                            $result = mysqli_query($mysqli, "SELECT distinct(product_category) from product");
                                if (mysqli_num_rows($result) > 0) {
                                    while($rows=mysqli_fetch_assoc($result))
                                    {
                                        echo "<li><form method=post action=category.php><input type='hidden' name='category1' value='".$rows['product_category']."'><a href='products.php'><button type='submit' name='productCategory1' class='liButton'>".$rows['product_category']."</button></a></form></li>";
                                    }
                                    echo "<li><a href='products.php'>All Products</a></li>";
                            }
                            else{
                            }
                            $mysqli->close();                         
                            ?>
                        </ul>
                    </li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php" class="contact">Contact</a></li>
                    <li><a href="login.php" id="login" class="login">Login</a></li>
                    <li><a href="signup.php" id="signup" class="login">Register</a></li>
                    <li><a id="profile" class="login"><i class="fa-solid fa-user"></i>  Profile</a>
                      <ul>
                            <li><a href="account.php"><i class="fa-solid fa-id-card"></i> Account</a></li>
                            <li class="cartButton"><a href="cart2.php"><i class="fa-solid fa-cart-shopping"></i>  Cart</a></li>
                            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                  </li>
                </ul>
            </nav>
        </header>
  <!-- <header>
    <nav class="main-nav">
      <input type="checkbox" id="check" />
      <label for="check" class="menu-btn">
        <i class="fas fa-bars"></i>
      </label>
      <a href="index.php"><img class="imageLogo" src="images/logo.png" alt="Noble Intermediates Private Limited"></a>
      <ul class="navlinks">
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php" class="contact">Contact</a></li>
          <li><a href="login.php" class="login">Login</a></li>
          <li><a href="signup.php" class="login">Register</a></li>
      </ul>
    </nav>
  </header> -->
  <div class="wrapper">
    <h2>Registration</h2>
    <form method="post">
      <div class="input-box">
        <input name="username" type="text" placeholder="Enter your name" required>
      </div>
      <div class="input-box">
        <input name="email" type="text" placeholder="Enter your email" required>
      </div>
      <div class="input-box">
        <input name="password" type="password" placeholder="Create password" required>
      </div>
      <div class="input-box">
        <input name="confirmPassword" type="password" placeholder="Confirm password" required>
      </div>
      <div class="policy">
        <input type="checkbox">
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="submit" name="submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Allready have an account? <a href="login.php">Login now</a></h3>
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
