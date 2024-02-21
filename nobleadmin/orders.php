<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
	header('location:login.php');
	die();
}
elseif(isset($_SESSION['admin_logged_in'])){
    echo '<script>myfunction();</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/orders.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="icon" type="image/png" href="logo3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <title>Noble Intermediates Admin | Orders</title>
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
    <div class="TableBG">
    <div class="UserInfo">
        <section>
        <h1 class="OrderDetails">Order Details</h1>
        <!-- TABLE CONSTRUCTION-->
        <table>
        <tr class="tableHead">
                <th>Order Id</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Product List</th>
                <th>Chemical Name</th>
                <th>Quantity</th>
                <th>Payable Amount</th>
                <th>Amount Paid</th>
                <th>Transaction status</th>
                <th>Product Price</th>
                <th>Address</th>
                <th colspan="2">Action</th>
                <!-- <th>Reject</th>                 -->
                <th>Call</th>
                <th>Send Mail</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            include 'conn.php';
            $result = mysqli_query($mysqli, "select * from orders");
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($rows=mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo "<td>" . $rows["order_process_id"] . "</td>";
                    echo "<td>" . $rows["username"] . "</td>";
                    echo "<td>" . $rows["email"] . "</td>";
                    echo "<td>" . $rows["contact"] . "</td>";
                    echo "<td>" . $rows["product_list"] . "</td>";
                    echo "<td>" . $rows["chemical_name"] . "</td>";
                    echo "<td>" . $rows["quantity"] . "</td>";
                    echo "<td>" . $rows["payable_amount"] . "</td>";
                    echo "<td>" . $rows["amount_paid"] . "</td>";
                    echo "<td>" . $rows["transaction_status"] . "</td>";
                    echo "<td>" . $rows["product_price"] . "</td>";
                    echo "<td>" . $rows["address"] . "</td>";
                    if($rows["confirmation_status"]=='pending'){
                        // echo "<td> <a class='StatusConfirmed' href=confirmorder.php?confirmation_status:".$rows["confirmation_status"]."><i class='fa-solid fa-circle-check'></i></a></td>";
                        echo "<td><form method='post' action='confirmorder.php'><input type='hidden' name='order_process_id' value='".$rows["order_process_id"]."'><button class='StatusConfirmed' type='submit'><i class='fa-solid fa-circle-check'></i></button></form></td>";
                        // echo "<td> <a class='StausNotConfirmed' href=rejectorder.php?confirmation_status:".$rows["confirmation_status"]."><i class='fa-solid fa-ban'></i></a></td>";
                        echo "<td><form method='post' action='rejectorder.php'><input type='hidden' name='order_processid' value='".$rows["order_process_id"]."'><button class='StausNotConfirmed' type='submit'><i class='fa-solid fa-ban'></i></button></form></td>";
                    }
                    elseif($rows["confirmation_status"]=='confirmed'){
                        echo "<td class='confirmed' colspan='2'>confirmed</td>";
                    }
                    else {
                        echo "<td class='rejected' colspan='2'>Rejected</td>";
                    }                
                    echo "<td> <a class='Call' href=tel:".$rows["contact"]."><button class='Call'><i class='fa-solid fa-phone'></i></button></a></td>";
                    // echo "<td> <a class='SendEmail' href=mailto:".$rows["email"]."><i class='fa-solid fa-envelope'></i></a></td>";                    // echo " </td>";
                    echo "<td><form method='post'><input type='hidden' name='orderId' value='".$rows["order_process_id"]."'><button class='SendEmail' name='SendEmail' type='submit'><i class='fa-solid fa-envelope'></i></a></button></form></td>";                 
                    echo '</tr>';
                    
                }
            } else {
                echo "0 results";
            }
            $mysqli->close();
               
            function SendEmailToUser(){
                include 'conn.php';
                $orderId=mysqli_real_escape_string($mysqli,$_POST['orderId']);
                mysqli_query($mysqli, "UPDATE orders SET send_email='yes' WHERE order_process_id='$orderId'");
                $mysqli->close();
                echo "<script>window.location.href='sendmail.php';</script>"; 
            }
            if(isset($_POST['SendEmail'])) {
                SendEmailToUser();
            }
             ?>
        </table>
    </section>
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