<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
	header('location:login.php');
	die();
}
if(isset($_SESSION['admin_logged_in'])){
	header('location:orders.php');
	die();
}
// elseif(isset($_SESSION['admin_logged_in'])){
//     echo '<script>myfunction();</script>';
// }
header('location:orders.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="logo3.png">
    <title>Noble Intermediates PVT LTD</title>
    <link rel="stylesheet" href="CSS/style2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
  </head>
  <?php
  echo "<body onLoad='myfunction();'>
  <script>
      function myfunction(){
          document.getElementById('login').style.display = 'none';
          
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
                <li><a href="login.php" id="login" class="login">Login</a></li>
                <li><a id="profile" class="login"><i class="fa-solid fa-user"></i>  Profile</a>
                <ul>                  
                <li><a href="signup.php" id="signup" ><i class="fa-solid fa-user-plus"></i> Register new Admin</a></li>
                <li><a href="logout.php" id="signup" > <i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>   
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
        <a href="index.php"><img class="imageLogo" src="logo.png" alt="Noble Intermediates Private Limited"></a>
        <ul class="navlinks">
          <li><a href="productsInfo.php">Products</a>
          </li>
          <li><a href="orders.php">Orders</a></li>
          <li><a href="userdata.php" class="contact">Users</a></li>
          <li><a href="https://app.respond.io/space/78337/message" target="_blank">Messages</a></li>
          <li><a href="adminsettings.php" id="login" class="login">Admins</a></li>
          <li><a href="login.php" id="login" class="login">Login</a></li>
          <li><a href="signup.php" id="signup" class="login">Register</a></li>
          <li><a href="logout.php" id="signup" class="login">Logout</a></li>         
        </ul>
      </nav>
    </header> -->
    <!-- This site is converting visitors into subscribers and customers with https://respond.io -->
    <!-- <script id="respondio__widget" src="https://cdn.respond.io/webchat/widget/widget.js?cId=aa1efbbb9388135de756a9279aa7cc12b52ceaa64cd965fca0982d568344fa58"></script> -->
    <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
  </body>
</html>