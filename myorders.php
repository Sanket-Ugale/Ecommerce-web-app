<?php
session_start();
if(!isset($_SESSION['logged_in'])){
	header('location:login.php');
	die();
}
?>
<?php 
include('conn.php');

?> 

<!DOCTYPE html> 
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="stylesheet" href="CSS/signupstyle.css">
    <script src="script.js"></script>
    <title>
      Noble Intermediates Private Limited | Orders
    </title>
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

  </div>
<style>
  .Divmain{
    background-color: white;
    text-align: center;
    font-family: 'Times New Roman', Times, serif;
    font-size:15px;
    height: 10%;
    width: 80%;
    margin-top: 10px;
    margin-left: 10%;
    margin-right: 10%;
    padding-bottom: 10px;
    padding:10px;
    border-radius: 3px;
    box-shadow:
  0 2.8px 2.2px rgba(0, 0, 0, 0.034),
  0 6.7px 5.3px rgba(0, 0, 0, 0.048),
  0 12.5px 10px rgba(0, 0, 0, 0.06),
  0 22.3px 17.9px rgba(0, 0, 0, 0.072),
  0 41.8px 33.4px rgba(0, 0, 0, 0.086),
  0 100px 80px rgba(0, 0, 0, 0.12)

}
i.Empty{
  font-size: 500px;
  color: white;
  background-repeat: no-repeat;
  text-align: center;
}
.reorderButton{
  padding: 5px;
  border: none;
  border-radius: 5px;
  font-size: large;
  font-family: 'Times New Roman', Times, serif;
  font-weight: bold;
  color: white;
  cursor: pointer;
  background-color: #0033FF;
}
.reorderButton:hover{
  background-color: #099FFF;
}
/* .ProductName{

}
.TotalAmount{

} */
</style>
  <?php



include 'conn.php';
  $User_name=$_SESSION['logged_in_username'];
  $username=mysqli_query($mysqli,"SELECT username from user WHERE email='$User_name'");
  $roww=mysqli_fetch_assoc($username);
  $u_sername=$roww['username'];
  $OrderDetails=mysqli_query($mysqli,"SELECT * FROM orders WHERE username='$u_sername'");
  $row=mysqli_fetch_assoc($OrderDetails);
  // $amount=$row['amount_paid'];
  if(true){
  while($row=mysqli_fetch_assoc($OrderDetails))
  {
   
      $amount=$row['amount_paid'];
      if(!$amount==0)
      {
        echo "
        <div class='Divmain'>
          <div class='ProductName'>
          <strong>Product Details:</strong>".$row['product_list']."
          </div>
          <div class='TotalAmount'>
          <strong>Amount Paid: </strong>".$row['amount_paid']."
          </div>
          <div class='OrderStatus'>
          <strong>Order Status: </strong>".$row['confirmation_status']."
          </div>
        ";
        if($row['confirmation_status']=='rejected'){
          echo "<div class='reorder'>
          <form method='post' ><input type='hidden' name='OrderProcessId' value='".$row['order_process_id']."'><button class='reorderButton' type='submit' name='reOrderButton'>Reorder</button></form>
          </div>";
        }         
        echo "</div>
        ";
      }
    }
  }
  else{
    echo "<center><i class='fa-solid fa-cart-shopping Empty'></i></center>";
  }
  
  if(isset($_POST['reOrderButton'])){
    reorder();
  }
  function reorder(){
    include 'conn.php';
    $amount=0;
    $productDetails=null;
    $RealUsername=null;
    $OrderProcessId=mysqli_real_escape_string($mysqli,$_POST['OrderProcessId']);
    $AllorderData=mysqli_query($mysqli,"SELECT * FROM orders WHERE order_process_id='$OrderProcessId'");
    $AllorderData=mysqli_fetch_assoc($AllorderData);
    $productDetails=$AllorderData['product_list'];
    $amount=$AllorderData['product_price'];
    $RealUsername=$AllorderData['username'];
    $amount=$AllorderData['payable_amount'];

    $time_now=mktime(date('h')+5,date('i')+30,date('s'));
    $day=date("l");
    $day =substr($day,0,-3);
    $Random=rand(11111,99999);
    $unique= $day.date('d_m_Y_h_i_sA', $time_now);
    $unique= str_replace('_','',$unique).$Random;
    // $productDetails=$AllorderData['product_list'];
    // $amount=$AllorderData['product_price'];
    // $RealUsername=$AllorderData['username'];
    // $amount=$AllorderData['payable_amount'];
    // if(isset($_SESSION['order_process_no'])){
    //   unset($_SESSION['logged_in']);
    //   unset($_SESSION['order_process_no']);
    //   die();
    // }
    $_SESSION['order_process_no']=$unique;
    // $_SESSION['logged_in']='yes';
		// $_SESSION['logged_in_username']=$email;
    mysqli_query($mysqli,"INSERT into orders(order_process_id,product_list,product_price,username,payable_amount) VALUES('$unique','$productDetails','$amount','$RealUsername','$amount')");
    echo "<script>window.location.href='PayUMoney_form.php';</script>";
    $mysqli->close();
  }
  $mysqli->close();
  ?>
  <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>
