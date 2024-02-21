<?php
session_start();
if(isset($_SESSION['admin_logged_in'])){
	header('location:index.php');
	die();
}
include('conn.php');
$msg= "";
// session_start();
if(isset($_POST['username']) && $_POST['password']){
  $username=mysqli_real_escape_string($mysqli,$_POST['username']);
	$email=mysqli_real_escape_string($mysqli,$_POST['username']);
	$password=mysqli_real_escape_string($mysqli,$_POST['password']);
  
	$res=mysqli_query($mysqli,"select * from admin where email='$email' OR username='$username'");
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
      $_SESSION['admin_logged_in']='yes';
		  $_SESSION['admin_logged_in_username']=$username;
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
    <title>Noble Intermediates Admin | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <link rel="icon" type="image/png" href="logo3.png">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  </head>
  <?php
  echo "<body onLoad='myfunction();'>
  <script>
      function myfunction(){
          document.getElementById('profile').style.display = 'none';
          
      }
  </script>"
  ?>
  <header>
    <a href="index.php"><img class="imageLogo" src="logo.png" alt="Noble Intermediates Private Limited"></a>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="menu-bar">
                <i class="fas fa-bars"></i>
              </label>

            <nav class="navbar">
                <ul>
                <li><a href="productsInfo.php">Products</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="userdata.php" class="contact">Users</a></li>
                <li><a href="https://app.respond.io/space/78337/message" target="_blank">Messages</a></li>
                <li><a href="login.php" id="login" class="login"><i class="fa-solid fa-user"></i> Login</a></li>
                <li><a id="profile" class="login"><i class="fa-solid fa-user"></i>  Profile</a>
                <ul>                  
                <li><a href="signup.php" id="signup" ><i class="fa-solid fa-user-plus"></i> Register new Admin</a></li>
                <li><a href="logout.php" id="signup" > <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>   
                </ul>
              </li>
                </ul>
            </nav>
        </header>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <form method="post">
          <div class="row">
            <i class="fas fa-user"></i>
            <input name="username" type="text" placeholder="Email or Username" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input name="password" type="password" placeholder="Password" required>
          </div>
          <div class="pass"><a href="forgotPassword.php">Forgot password?</a></div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
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
