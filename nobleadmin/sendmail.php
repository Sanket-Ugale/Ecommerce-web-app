<?php
// include('smtp/PHPMailerAutoload.php');
include('smtpMailFunction.php');
include('conn.php');
$msg="";
$confirmPassword="";
$password="";
$res=mysqli_query($mysqli,"SELECT * FROM orders WHERE send_email='yes'");
$row=mysqli_fetch_assoc($res);
if(isset($_POST['message'])){
	$name=$row['username'];
	$email=$row['email'];
	$OrderId=$row['order_process_id'];
  $message=mysqli_real_escape_string($mysqli,$_POST['message']);
  mysqli_query($mysqli,"UPDATE orders SET send_email='no'");
  // $msg="Sending...... ";
  if($message==null){
		$msg="Sorry, Message Can't be blank.";
	}
  else{		
    $msg="Email Successfully Send.";
		$mailHtml=" 

    <body>
    <table class='main' style='padding: 25px;
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
                <div class='title' style='text-align: center;
                font-size: x-large;
                font-weight:900;'>
                    Noble Intermediates Private Limited
                </div>
            </td>
        </tr>
        <tr>
            <td colspan='4'>
                <div class='title' style='text-align: left;
                font-size: large;
                font-weight:900;'>
                '$name' You have Message From Noble Intermediates Private Limited.
                </div>
            </td>
        </tr>
        <tr>
            <td class='date' colspan='4' style='text-align: right;
            padding-top: 10px;
            padding-bottom: 20px;'>
                Date: ".date('l d-m-Y')."
            </td>
        </tr>
        <tr class='one' style='padding-top: 20px;'>
            <th style='padding: 10px;
            border-top: 1px solid white;
            border-bottom: 1px solid white;'>
                Order Id
            </th>
            <th style='padding: 10px;
            border-top: 1px solid white;
            border-bottom: 1px solid white;'>
                Name
            </th>
            <th style='padding: 10px;
            border-top: 1px solid white;
            border-bottom: 1px solid white;'>
                Email
            </th>
            <th style='padding: 10px;
            border-top: 1px solid white;
            border-bottom: 1px solid white;'>
                Message
            </th>
        </tr>
        <tr class='two'>
            <td class='selcted' style='padding: 5px;'>
                '$OrderId'
            </td>
            <td class='selcted' style='padding: 5px;'>
                '$name'
            </td>
            <td class='selcted' style='padding: 5px;'>
                '$email'
            </td>
            <td class='selcted' style='padding: 5px;'>
                '$message'
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
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/facebook.png' alt='facebook' style='width: 30px; height: 30px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/twitter.png' alt='twitter' style='width: 30px; height: 30px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/whatsapp.png' alt='whatsapp' style='width: 30px; height: 30px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/linkedin.png' alt='linkedin' style='width: 30px; height: 30px;'>
            </td>
            <td>
                <img src='https://nobleintermediates.000webhostapp.com/images/icons/instagram.png' alt='instagram' style='width: 30px; height: 30px;'>
            </td>
            <td>
                <a href='https://nobleintermediates.000webhostapp.com'></a><img src='https://nobleintermediates.000webhostapp.com/images/icons/website.png' alt='website' style='width: 30px; height: 30px;'></a>
            </td>
        </tr>
    </table>
</body>
    
    ";
    $message= "Noble Intermiediates Private  Limited";
		smtp_mailer($email, $message, $mailHtml);    		
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
    <link rel="icon" type="image/png" href="logo3.png">
     <link rel="stylesheet" href="CSS/style2.css">
     <title>Noble Intermediates Admin | Send Email</title>
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
  <div class="wrapper">
    <h2>Send Email</h2>
    <form method="post">
      <div class="input-box">
        <input name="username" type="text" placeholder="Enter name" value="<?php echo $row['username']; ?>" disabled required>
      </div>
      <div class="input-box">
        <input name="email" type="text" placeholder="Enter email" value="<?php echo $row['email']; ?>" disabled required>
      </div>
      <div class="input-box">
        <input name="order_id" type="text" placeholder="Enter order id" value="<?php echo $row['order_process_id']; ?>" disabled required>
      </div>
      <div class="input-box">
        <input name="message" type="text" placeholder="Message ......" required>
      </div> 
      <div class="input-box button">
        <input type="submit" name="submit" value="Send">
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
