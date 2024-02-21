<?php
if(isset($_SESSION['logged_in'])){
header('products.php');
die();
}
include('conn.php');
$msg= "";
session_start();
if(isset($_POST['email']) && $_POST['password']){
  $username=mysqli_real_escape_string($mysqli,$_POST['email']);
	$email=mysqli_real_escape_string($mysqli,$_POST['email']);
	$password=mysqli_real_escape_string($mysqli,$_POST['password']);
	$res=mysqli_query($mysqli,"SELECT * from user where email='$email' or username='$username' and password='$password'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$verification_status=$row['verification_status'];
    $verify=password_verify($password,$row['password']);
		if($verification_status==0){
            $msg= "You have not confirmed your account yet. Please check your inbox and verify your email id.";
		}
    elseif($verify!=1){
			$msg= "Password not matched";
		}
    else{
			$msg= "done";
      $_SESSION['logged_in']='yes';
		  $_SESSION['logged_in_username']=$email;
		  header('location:index.php');
		  die();
		}
	}else{
		$msg= "Please enter correct login details";
	}
}
$mysqli -> close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Noble Intermediates | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="images/logo3.png">
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
                </ul>
            </nav>
        </header>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <form method="post">
          <div class="row">
            <i class="fas fa-user"></i>
            <input name="email" type="text" placeholder="Email or Username" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input name="password" type="password" placeholder="Password" required>
          </div>
          <div class="pass"><a href="forgotPassword.php">Forgot password?</a></div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="signup.php">Signup now</a></div>
          <div class="message">
            <?php
            echo $msg;
            ?>
          </div>
          
        </form>
      </div>
    </div>
<style>
       div.disclaimer
    {
        display:none;
    }
  </style>
  </body>
</html>
