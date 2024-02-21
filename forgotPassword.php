<?php
include('conn.php');
include('smtp/PHPMailerAutoload.php');
$msg= "";
session_start();
if(isset($_POST['username'])){
	$email=mysqli_real_escape_string($mysqli,$_POST['username']);
	$username=mysqli_real_escape_string($mysqli,$_POST['username']);
	$res=mysqli_query($mysqli,"select * from user where email='$email' or username='$username'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$sendEmail=$row['email'];
        $reset_id=rand(111111111,999999999);
		
		mysqli_query($mysqli,"UPDATE user SET reset_id='$reset_id' ,reset_status='0' WHERE email='$sendEmail'");

        $msg="We've just sent Reset link to <strong>$sendEmail</strong>. Please check your inbox and click on the link to Reset Password. If you can't find this email (which could be due to spam filters), just request a new one here.";
		
		$mailHtml="
    <body>

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
                <p class='paragraph' style='color:white'>You can reset Your password by clicking the button below:</p><p></p> <br>
                <a style='color: white;
                border-radius: 8px;
                text-decoration: none;
                background-color: rgb(255, 166, 1);
                padding: 10px;
                box-shadow: 2px 2px 2px 2px rgb(0, 0, 0); '' href='https://nobleintermediates.000webhostapp.com/reset.php?id=$reset_id' 
                onmouseover='this.style.backgroundcolor= '#FF0000';
                this.style.padding= '12px';'

                onmouseout='this.style.backgroundColor='#FF2D00';
                this.style.padding= '10px';'
                >Reset Password</a><br><br> <strong style='color:white'> or go to</strong><br> <br><a style='padding-top: 9px;
                text-decoration: none;
                color: white; 
                ' href='https://nobleintermediates.000webhostapp.com/reset.php?id=$reset_id'>https://nobleintermediates.000webhostapp.com/reset.php?id=$reset_id</a></p>

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
</body>
    
    ";
        $message= "Noble Intermiediates Private  Limited";
		smtp_mailer($sendEmail, $message, $mailHtml);
		
	}else{
		$msg= "Please Enter a correct Email or Username";
	}
}
  $mysqli -> close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Intermediates | Forgot Password</title>
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/forgetPassword.css"> 
</head>
<body>
<header>
    <a href="index.php"><img class="imageLogo" src="images/logo.png" alt="Noble Intermediates Private Limited"></a>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="menu-bar">
                <i class="fas fa-bars"></i>
              </label>

            <nav class="navbar">
                <ul>
                    <li><a href="products.php">Products <i class="fa-solid fa-chevron-down"></i></a>
                    <!-- <i class="fa-solid fa-chevron-down"></i> -->
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
                    <!-- <li><a href="logout.php" id="profile" class="login"><i class="fa-solid fa-user"></i></a></li> -->
                </ul>
            </nav>
        </header>
    <div class="wrapper">
        <h2>Forgot Password</h2>
        <form method="post">
          <div class="input-box">
            <input name="username" type="text" placeholder="Enter Username or Email" required>
          </div>
          <div class="input-box button">
            <input type="submit" name="submit" value="Send Reset Link">
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