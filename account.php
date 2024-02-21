<!-- <?php 
session_start();
// if(!isset($_SESSION['logged_in'])){
// 	header('location:login.php');
// 	die();
// }
include('conn.php');
$msg="";
$confirmPassword="";
$password="";
$username=$_SESSION['logged_in_username'];
// $res=mysqli_query($mysqli,"SELECT * from user where email='$username'");
// $row=mysqli_fetch_assoc($res);
$query = "SELECT * from user where email='$username'"; 
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($mysqli,$_POST['username']);
	$email=mysqli_real_escape_string($mysqli,$_POST['email']);
	$phone=mysqli_real_escape_string($mysqli,$_POST['phone']);
  $address=mysqli_real_escape_string($mysqli,$_POST['address']);
	$check=mysqli_num_rows(mysqli_query($mysqli,"select * from user where email='$email'"));
	

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg = "Invalid Email format"; 
  }
  elseif(strlen($phone)<10 || strlen($phone)>10){
    $msg="Invalid Mobile Number";
  }
  elseif(!$check>0){
    $msg="Please Enter Registered Email";
  }
  else{	
    mysqli_query($mysqli,"UPDATE user SET contact='$phone' ,address='$address' WHERE email='$email'");	
    $msg="Your Data Updated Successfully ";
    echo "<script>window.location.href='account.php';</script>";
    // $msg= "<script><a href='location.reload();'></a>Refresh</script>";
	}
}

?> -->

<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/signupstyle.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/account.css">
    <link rel="icon" type="image/png" href="images/logo3.png">
   </head>
   <?php
  echo "<body onLoad='myfunction();'>
  <script>
      function myfunction(){
          document.getElementById('login').style.display = 'none';
          document.getElementById('signup').style.display = 'none';
          
      }
  </script>"
  ?>
  <div id="loader" class="center"></div>
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
                    <li><a id="profile" class="login"><i class="fa-solid fa-user"></i>  Profile</a>
                      <ul>
                            <li><a href="account.php"><i class="fa-solid fa-id-card"></i> Account</a></li>
                            <li class="cartButton"><a href="cart2.php"><i class="fa-solid fa-cart-shopping"></i>  Cart</a></li>
                            <li><a href="myorders.php"><i class="fa-solid fa-cart-flatbed"> </i> Orders</a></li>
                            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                        </ul>
                  </li>
                </ul>
            </nav>
        </header>
  <div class="wrapper">
    <h2>Account Information</h2>
    <form method="post">
      <div class="row">
        <i class="fas fa-user"></i>
        <input name="username" type="text" placeholder="Enter your name" value="<?php echo $row['username'];?>" required>
      </div>
      <div class="row">
        <i class="fa-solid fa-envelope"></i>
        <input name="email" type="text" placeholder="Enter your email" value="<?php echo $row['email'];?>" required>
      </div>
      <div class="row">
        <i class="fa-solid fa-phone"></i>
        <input name="phone" type="number" placeholder="Phone Number" value="<?php echo $row['contact'];?>" required>
      </div>
      <div class="row">
        <i class="fa-solid fa-location-dot"></i>
        <input class="address" name="address" type="text" placeholder="Enter Delivery Address" value="<?php echo $row['address'];?>" required>
      </div>
      <div class="row button">
        <input type="submit" name="submit" value="Update">
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
