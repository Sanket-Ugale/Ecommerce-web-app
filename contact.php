<?php
// session_start();
// if(!isset($_SESSION['logged_in'])){
// 	header('location:login.php');
// 	die();
// }
// include('smtp/PHPMailerAutoload.php');
include('smtpMailFunction.php');
include('conn.php');
$msg="";
echo "<script>var a=0;</script>";
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($mysqli,$_POST['name']);
	$email=mysqli_real_escape_string($mysqli,$_POST['email']);
	$phone=mysqli_real_escape_string($mysqli,$_POST['phone']);
    $messages=mysqli_real_escape_string($mysqli,$_POST['messages']);
    // mysqli_query($mysqli,"insert into user(username,email,password,verification_status,verification_id) values('$name','$email','$password',0,'$verification_id')");
	$mailHtml="<body>
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
                  New Form Submitted
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
              Phone Number
          </th>
          <th style='padding: 10px;
          border-top: 1px solid white;
          border-bottom: 1px solid white;'>
              Message
          </th>
      </tr>
      <tr class='two'>
          <td class='selcted' style='padding: 5px;'>
              '$name'
          </td>
          <td class='selcted' style='padding: 5px;'>
              '$email'
          </td>
          <td class='selcted' style='padding: 5px;'>
              '$phone'
          </td>
          <td class='selcted' style='padding: 5px;'>
              '$messages'
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
              <img src='https://nobleintermediates.000webhostapp.com/images/icons/website.png' alt='website' style='width: 30px; height: 30px;'>
          </td>
      </tr>
  </table>
</body>";
  $message= "Noble Intermiediates Private  Limited";
  $mailTo='';
	smtp_mailer($mailTo, $message, $mailHtml);
  $msg="Form Submitted Successfully";
// swal("Form Submitted", "Contact Form Submitted Successfully.", "success");
    // 
}
else{
    // $msg="Error occured Sending form";
}
  $mysqli -> close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Intermediates | Contact </title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="CSS/contact.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="images/logo3.png">
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
else{
    echo "<body onLoad='myfunction();'>
    <script>
        function myfunction(){
            document.getElementById('profile').style.display = 'none';            
        }
    </script>";
}


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
                    <li><a href='products.php'>Products <i class="fa-solid fa-chevron-down"></i></a>
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

      <div class="contact-form">
        <div class="container">
          <div class="wrapper">
            <div class="title"><span>Contact</span></div>
            <form method="post">
              <div class="row">
                <i class="fas fa-user"></i>
                <input name="name" type="text" placeholder="Name" required>
              </div>
              <div class="row">
                <i class="fa-solid fa-envelope"></i>
                <input name="email" type="email" placeholder="Email" required>
              </div>
              <div class="row">
                <i class="fa-solid fa-phone"></i>
                <input name="phone" type="phone" placeholder="Phone Number" required>
              </div>
              <div class="row"> 
                <i class="fa-solid fa-message"></i>
                <textarea name="messages" id="" type="text" placeholder="Message..." required cols="50" rows="3"></textarea>
              </div>
              <div class="row button">
                <input name="submit" type="submit" value="Submit" display='none'>
              </div>
              <div class="message">
                <?php
                echo $msg;
                ?>
              </div>
              
            </form>
          </div>
        </div>
      </div>

    <div class="info"><br><br>
        <h2 class="getintouch">Get in touch</h2>
        <span class="info">
            <center>
                <br>
                <span class="phoneno" href onclick="window.open('tel:+91-7888024770','_blank');">
                <b>P:</b>  +91-7888024770 </span>
                <br> 
                <span class="email" href onclick="window.open('mailto:info@nobleintermediates.com','_blank');">
                    <b>Email:</b> info@nobleintermediates.com 
                </span>
                <br>
                <span class="email" href onclick="window.open('mailto:marketing@nobleintermediates.com','_blank');">
                    <b>Email:</b> marketing@nobleintermediates.com </span>
                    <br> <br>
                    <span class="address">
                    <b>Address:</b> <br> 
                    <span href onclick="window.open('https://goo.gl/maps/VT9tiWnCq9wYYQ1i7','_blank');">
                        602, Dwarka Mai Apartment, Near Old Indian oil petrol pump, Katrap

                        <br> Badlapur (E)- 421503
                    </span>
                </span>
            </center>
        </span>
    <div class="logos">
        <a href onclick="window.open('https://twitter.com/','_blank');">
             <img class="logo" src="images/tw4.png" ></a>
             <a href onclick="window.open('mailto:info@nobleintermediates.com','_blank');">
             <img class="logo" src="images/mail4.png"></a>
             <a href onclick="window.open('https://www.youtube.com/','_blank');">
             <img class="logo" src="images/yt4.1.png"></a>
             <a href onclick="window.open('https://www.linkedin.com/in','_blank');">
             <img class="logo" src="images/li4.png"></a>
             <a href onclick="window.open('https://www.instagram.com/','_blank');">
             <img class="logo" src="images/i4.png"></a>
             <a href onclick="window.open('https://www.blogger.com/','_blank');">
             <img class="logo" src="images/blog4.png"></a>
             <a href onclick="window.open('tel:7888024770','_blank');">
             <img class="logo" src="images/wh4.png"></a>
             <a href onclick="window.open('https://www.google.com/maps/search/nobleintermediates/@19.1626504,73.2278357,15z/data=!3m1!4b1','_blank');">
             <img class="logo" src="images/location4.png"></a>
         </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15075.563815812386!2d73.24338!3d19.15625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb8bf22317f624df1!2sNOBLE%20INTERMEDIATES%20PRIVATE%20LIMITED!5e0!3m2!1sen!2sin!4v1645932768419!5m2!1sen!2sin" width="90%" height="250px" style="border:0; margin-top:50px; margin-left:5%" allowfullscreen="" loading="lazy"></iframe>

  
<div class="footer" style="color:white; text-align:center;">
&copy; 2022 nobleintermediates
</div>
<!-- This site is converting visitors into subscribers and customers with https://respond.io --><script id="respondio__widget" src="https://cdn.respond.io/webchat/widget/widget.js?cId=aa1efbbb9388135de756a9279aa7cc12b52ceaa64cd965fca0982d568344fa58"></script><!-- https://respond.io -->
<style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>