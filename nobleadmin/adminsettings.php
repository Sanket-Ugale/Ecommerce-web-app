<?php
include('conn.php');
$msg="";
$confirmPassword="";
$password="";
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($mysqli,$_POST['username']);
	$email=mysqli_real_escape_string($mysqli,$_POST['email']);
	$password=mysqli_real_escape_string($mysqli,$_POST['password']);
    $confirmPassword=mysqli_real_escape_string($mysqli,$_POST['confirmPassword']);
    $users=mysqli_real_escape_string($mysqli,$_POST['Users']);
    $orders=mysqli_real_escape_string($mysqli,$_POST['Orders']);
	$produts=mysqli_real_escape_string($mysqli,$_POST['Products']);
	$check=mysqli_num_rows(mysqli_query($mysqli,"select * from user where email='$email'"));
	
	if($check>0){
		$msg="Email id already present";
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
    mysqli_query($mysqli,"INSERT into admin(username,email,password,verification_status,verification_id) values('$name','$email','$pass',0,'$verification_id')");
	$msg="We've just sent a verification link to <strong>$email</strong>. Please check your inbox and click on the link to get started. If you can't find this email (which could be due to spam filters), just request a new one here.";
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
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/adminsettings.css">
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
    <a href="index.php"><img class="imageLogo" src="logo.png" alt="Noble Intermediates Private Limited"></a>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="menu-bar">
                <i class="fas fa-bars"></i>
              </label>

            <nav class="navbar">
                <ul>
                    <li><a>Products <i class="fa-solid fa-chevron-down"></i></a>
                        <ul>
                            <li><a href="products.php">Chemical Lumps</a></li>
                            <li><a href="products.php">Chemical Powder</a></li>
                            <li><a href="products.php">Chemical Solution</a></li>
                            <li><a href="products.php">Antimony Salts</a></li>
                            <li><a href="products.php">Other Products</a></li>
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
    <h2>Create New Admin</h2>
    <form method="post">
      <div class="input-box">
        <input name="username" type="text" placeholder="Admin name" required>
      </div>
      <div class="input-box">
        <input name="email" type="text" placeholder="Admin email" required>
      </div>
      <div class="input-box">
        <input name="password" type="password" placeholder="password" required>
      </div>
      <div class="input-box">
        <input name="confirmPassword" type="password" placeholder="Confirm password" required>
      </div>
      <div>
        <label class="TitleLable" for="">Give Access of:</label><br>
        <input class="Accesscheckbox" type="checkbox" name="Users" id="Users">
        <label class="OptionLable" for="">Users</label><br>
        <input class="Accesscheckbox" type="checkbox" name="Products" id="Products">
        <label class="OptionLable" for="">Products</label><br>
        <input class="Accesscheckbox" type="checkbox" name="Orders" id="Orders">
        <label class="OptionLable" for="">Orders</label><br>
      </div>
      <div class="input-box button">
        <input type="submit" name="submit" value="Create">
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
