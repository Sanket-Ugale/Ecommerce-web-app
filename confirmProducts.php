<?php
include 'conn.php';
$msg='';
$amount=0;
$productDetails=null;
$RealUsername=null;
$user=mysqli_real_escape_string($mysqli,$_POST['username']);
$username=str_replace('_',' ',$user);

$CheckDetailsquery = mysqli_query($mysqli,"SELECT address, contact FROM user WHERE username='$username'");
$CheckDetailRows=mysqli_fetch_assoc($CheckDetailsquery);
$BuyAllquery = mysqli_query($mysqli,"SELECT * FROM cart WHERE username='$username'");
if (mysqli_num_rows($BuyAllquery) > 0) {
    while($BuyAllrows=mysqli_fetch_assoc($BuyAllquery))
    {
        $getUsername= $BuyAllrows['username'];
        $productDetails=$productDetails.$BuyAllrows['product_id'].", ".$BuyAllrows['product_name']."  (".$BuyAllrows['quantity'].") RS:".$BuyAllrows['price']." <br> ";
        $amount=$BuyAllrows['price']+$amount;
    }
    // $GLOBALS['price']=$amount;
    
    $RealUsername=mysqli_query($mysqli,"SELECT username FROM user WHERE email='$getUsername'");
    $RealUsername=mysqli_fetch_assoc($RealUsername);
    $RealUsername=$RealUsername['username'];   
    // mysqli_query($mysqli,"INSERT INTO orders (product_list,username,product_price,payable_amount) VALUES('$productDetails','$RealUsername','$amount','$amount')");
    // mysqli_query($mysqli,"INSERT INTO orders()'");

if(isset($_POST['AddToDatabase']) || isset($_POST['submit'])) {
    // AddToDatabase();
    // function AddToDatabase(){
        // include 'conn.php';
            $username=mysqli_real_escape_string($mysqli,$_POST['username']);
            $email=mysqli_real_escape_string($mysqli,$_POST['email']);
            $contact=mysqli_real_escape_string($mysqli,$_POST['contact']);
            $address=mysqli_real_escape_string($mysqli,$_POST['address']);
            // $price=mysqli_real_escape_string($mysqli,$_POST['amount1']);
            // $price=$GLOBALS['amount'];
            // global $amount;
            // global $productDetails;
            // global $RealUsername;
            echo "<script>alert('".$amount."');</script>";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "Invalid email format";
              }
              elseif(strlen($contact)>10 && strlen($contact)<10){
                $msg="Invalid Mobile Number.";
              }elseif(true){
                // mysqli_query($mysqli,"UPDATE orders SET contact='$contact',email='$email',address='$address' WHERE username='$RealUsername'");
                mysqli_query($mysqli,"INSERT INTO orders (product_list,product_price,username,contact,email,address,payable_amount) VALUES('$productDetails','$amount','$RealUsername','$contact,'$email','$address','$amount')");

                $msg="Delivery details submitted";
            } 
            else{
                echo "<script>alert('ERROR');</script>";
            }  
            //   $mysqli->close();
        // }
}
}
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Intermediates Private Limited</title>
    <link rel="stylesheet" href="CSS/confirmProducts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="images/logo3.png">
</head>
<body>
    <?php
    include 'conn.php';
    $userData=mysqli_query($mysqli,"SELECT * FROM user WHERE username='$RealUsername'");
    $userAllData=mysqli_fetch_assoc($userData);
    
    ?>
<div class="container">
      <div class="wrapper">
        <div class="title"><span>Confirm your details</span></div>
        <!-- action="PayUMoney-PHP-Module-master\PayUMoney_form.php" -->
        <form method="post">
          <div class="row">
              Name
            <input name="username" type="text" placeholder="Name" value="<?php echo $userAllData['username'];?>" required>
          </div>
          <div class="row">
              Email
            <input name="email" type="email" placeholder="Email" value="<?php echo $userAllData['email'];?>" required>
          </div>
          <div class="row">
              Contact Number
            <input name="contact" type="number" placeholder="Mobile Number" value="<?php echo $userAllData['contact'];?>" required>
          </div>
          <div class="row">
              Amount to pay (RS)
            <input name="amount1" placeholder="Final Amount" value="<?php echo $amount ?>" disabled  required>
          </div>
         <!--  <div class="row">
              Product Details
              <?php //echo $productDetails;?> -->
            <!-- <textarea name="ProductDetails" type="text" placeholder="Product details" rows="3" cols="53" style="resize: none;" value="<?php echo $productDetails ?>" disabled required></textarea> -->
          <!-- </div><br> --> 
          <div class="row">
              Address (Delivery address)
            <input name="address" type="text" placeholder="Address" value="<?php echo $userAllData['address'];?>" required>
          </div><br>
          <div class="row button">
            <input type="submit" name="AddToDatabase" value="Confirm">
          </div>
          <div class="message">
            <?php
            echo $msg;
            ?>
          </div>
          
        </form>
      </div>
      <?php
      $mysqli->close();
      ?>
    </div>
    <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>