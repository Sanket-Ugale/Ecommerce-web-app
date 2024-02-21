<?php
session_start();
if(!isset($_SESSION['logged_in'])){
	header('location:login.php');
	die();
}
// elseif(isset($_SESSION['admin_logged_in'])){
//     echo '<script>myfunction();</script>';
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/cart.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="icon" type="image/png" href="images/logo3.png">
    <title>Noble Intermediates | Cart</title>
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
    <div class="TableBG">
        <section>
        <h1 class="CartTitle">Your Cart</h1>
            <?php   
            include 'conn.php';
            $LoginedUser=$_SESSION['logged_in_username'];
                $result3=mysqli_query($mysqli,"SELECT * from cart where username='$LoginedUser'");
                $check=mysqli_num_rows($result3);
                if($check>0){
                
                echo "<form method='post'><input type='hidden' name='username' value='".str_replace(' ','_',$LoginedUser)."'><button id='buttonRemBuy' type='submit' class='removeAll' name='CartButtonRemoveAll'>Remove All</button></form>";
                echo "<form method='post'><input type='hidden' name='username' value='".str_replace(' ','_',$LoginedUser)."'><button id='buttonRemBuy' type='submit' class='selectAll' name='CartButtonBuyAll'>Buy All</button></form>";
                // $check=mysqli_num_rows($res);
                // action='PayUMoney-PHP-Module-master/PayUMoney_form.php'
                while($rows=mysqli_fetch_array($result3))
                {
                    echo "<table class='Cart-Container'>";
                    echo '<tr>';
                    echo "<td><form method='post'><input type='hidden' name='productNam' value='".str_replace(' ','_',$rows["product_name"])."'><input type='hidden' name='username' value='".str_replace(' ','_',$rows["username"])."'><button class='CartButtonRemove ' name='CartButtonRemove' type='submit'><i class='fa-solid fa-xmark'></i></button></form></td>";
                    echo "<td>" . $rows["product_name"] . "</td>";
                    echo "<td>" . $rows["chemical_name"] . "</td>";
                    echo "<td colspan='3'><form method='post'><input type='hidden' name='productNam' value='".str_replace(' ','_',$rows["product_name"])."'><input type='hidden' name='username' value='".str_replace(' ','_',$rows["username"])."'><button class='QuantityButton' name='CartQuantityDecrement' type='submit'><i class='fa-solid fa-minus'></i></button></form>";
                    echo $rows["quantity"]." ".$rows['unit'];
                    echo "<form method='post'><input type='hidden' name='productNam' value='".str_replace(' ','_',$rows["product_name"])."'><input type='hidden' name='username' value='".str_replace(' ','_',$rows["username"])."'><button class='QuantityButton' name='CartQuantityIncrement' type='submit'><i class='fa-solid fa-plus'></i></button></form></td>";                    
                    echo "<td><i class='fa-solid fa-indian-rupee-sign'></i>  " . $rows["price"] . "</td>";
                    echo "<td><form method='post'><input type='hidden' name='productNam_e' value='".str_replace(' ','_',$rows["product_name"])."'><input type='hidden' name='usernam_e' value='".str_replace(' ','_',$rows["username"])."'><button class='CartButtonBuy' name='CartButtonBuy' type='submit'><i class='fa-solid fa-cart-plus'></i> Buy</a></button></td></form>";
                    echo '</tr>';
                    echo "</table>";
                }
                
            } else {
                echo "<span class='emptyMsg'> is Empty </span> ";
                echo "<script>
                <body onLoad='HideButton();'>
                function HideButton(){
                    document.getElementById('buttonRemBuy').style.display = 'none';
                }
                </script></body>";
            }
               
             ?>
        
    </section>
    </div>
    <?php
    function decrementProducts(){
        include 'conn.php';
        $productNam=mysqli_real_escape_string($mysqli,$_POST['productNam']);
        $productNam=str_replace('_',' ',$productNam);
        $user=mysqli_real_escape_string($mysqli,$_POST['username']);
        $username=str_replace('_',' ',$user);
        $query1=mysqli_query($mysqli,"SELECT * from cart WHERE username='$username'  AND product_name='$productNam'");
        $rows=mysqli_fetch_assoc($query1);
        $quantity=$rows["quantity"];
        if($quantity>1)
        {

            $productName=$rows["product_name"];
            $pastQuantity=$rows["quantity"];

            $query3=mysqli_query($mysqli,"SELECT * from product WHERE product_name='$productName'");
            $row2=mysqli_fetch_assoc($query3);
            $OriganalPrice=$row2["product_price"];

            $newPrice=$rows["price"] - $OriganalPrice;
            $newQuantity=$pastQuantity - 1;

            $query2 = mysqli_query($mysqli,"UPDATE cart set quantity='$newQuantity', price='$newPrice' WHERE username='$username'  AND product_name='$productNam'"); 
        }
        else{

        }
        echo "<script>window.location.href='cart2.php';</script>";
        $mysqli->close();
    }

    function incrementProducts(){
        include 'conn.php';
        // $mysqli = new mysqli("localhost","root","","website");
        $productNam=mysqli_real_escape_string($mysqli,$_POST['productNam']);
        $productNam=str_replace('_',' ',$productNam);
        $user=mysqli_real_escape_string($mysqli,$_POST['username']);
        $username=str_replace('_',' ',$user);

        $query1=mysqli_query($mysqli,"SELECT * from cart WHERE username='$username' AND product_name='$productNam'");
        $rows=mysqli_fetch_assoc($query1);
        // $productName=$rows["product_name"];
        $pastQuantity=$rows["quantity"];

        $query3=mysqli_query($mysqli,"SELECT * from product WHERE product_name='$productNam'");
        $row2=mysqli_fetch_assoc($query3);
        $OriganaPrice=$row2["product_price"];

        $newPrice=$rows["price"]+$OriganaPrice;
        $newQuantity=$pastQuantity + 1;

        $query2 = mysqli_query($mysqli,"UPDATE cart set quantity='$newQuantity', price='$newPrice' WHERE username='$username' AND product_name='$productNam'"); 
        echo "<script>window.location.href='cart2.php';</script>";
        $mysqli->close();
    }

    function removefromCart(){
        include 'conn.php';
        $user=mysqli_real_escape_string($mysqli,$_POST['username']);
        $username=str_replace('_',' ',$user);
        $productNam=mysqli_real_escape_string($mysqli,$_POST['productNam']);
        $productNam=str_replace('_',' ',$productNam);
        $query = mysqli_query($mysqli,"DELETE FROM cart WHERE username='$username' and product_name='$productNam'"); 
        echo "<script>window.location.href='cart2.php';</script>";
        $mysqli->close();
        // header("Location: cart.php"); 
    }

    function removeAll(){
        include 'conn.php';
        $user=mysqli_real_escape_string($mysqli,$_POST['username']);
        $username=str_replace('_',' ',$user);
        $query = mysqli_query($mysqli,"DELETE FROM cart WHERE username='$username'");
        echo "<script>window.location.href='cart2.php';</script>";
        $mysqli->close();
    }

    function BuyAll(){
        include 'conn.php';
        $user=mysqli_real_escape_string($mysqli,$_POST['username']);
        $username=str_replace('_',' ',$user);
        $CheckDetailsquery = mysqli_query($mysqli,"SELECT address, contact FROM user WHERE username='$username'");
        $CheckDetailRows=mysqli_fetch_assoc($CheckDetailsquery);
            $amount=0;
            $productDetails=null;
            $RealUsername=null;
            // $chemicalName=null;
        $BuyAllquery = mysqli_query($mysqli,"SELECT * FROM cart WHERE username='$username'");
        if (mysqli_num_rows($BuyAllquery) > 0) {
            while($BuyAllrows=mysqli_fetch_assoc($BuyAllquery))
            {
                $getUsername= $BuyAllrows['username'];
                $productDetails=$productDetails.$BuyAllrows['product_id'].", ".$BuyAllrows['product_name']."  (".$BuyAllrows['quantity'].") RS:".$BuyAllrows['price']." ";
                 $amount=$BuyAllrows['price']+$amount;
            }
            $RealUsername=mysqli_query($mysqli,"SELECT username FROM user WHERE email='$getUsername'");
            $RealUsername=mysqli_fetch_assoc($RealUsername);
            $RealUsername=$RealUsername['username'];
            $time_now=mktime(date('h')+5,date('i')+30,date('s'));
            $day=date("l");
            $day =substr($day,0,-3);
            $Random=rand(11111,99999);
            $unique= $day.date('d_m_Y_h_i_sA', $time_now);
            $unique= str_replace('_','',$unique).$Random;
            mysqli_query($mysqli,"INSERT into orders(order_process_id,product_list,product_price,username,email,payable_amount) VALUES('$unique','$productDetails','$amount','$RealUsername','$getUsername','$amount')");
            $_SESSION['order_process_no']=$unique;
            echo "<script>window.location.href='PayUMoney_form.php';</script>"; 
        }
        $mysqli->close();
    }

    function Buy(){
        include 'conn.php';
        $user=mysqli_real_escape_string($mysqli,$_POST['usernam_e']);
        $username=str_replace('_',' ',$user);
        $email=$_SESSION['logged_in_username'];
        $productNam=mysqli_real_escape_string($mysqli,$_POST['productNam_e']);
        $productNam=str_replace('_',' ',$productNam);
        $amount=0;
        $productDetails=null;
        $RealUsername=null;
        $Buyquery = mysqli_query($mysqli,"SELECT * FROM cart WHERE username='$username' AND product_name='$productNam'");
        if (mysqli_num_rows($Buyquery) > 0) {
        while($Buyrows=mysqli_fetch_assoc($Buyquery))
        {
            // echo $BuyAllrows['username'];
            $productDetails=$Buyrows['product_id'].", ".$Buyrows['product_name']."  (".$Buyrows['quantity'].") <br> ";
            $amount=$Buyrows['price']+$amount;
        }
        $RealUsername=mysqli_query($mysqli,"SELECT username FROM user WHERE email='$email'");
        $RealUsername=mysqli_fetch_assoc($RealUsername);
        $RealUsername=$RealUsername['username'];
        $time_now=mktime(date('h')+5,date('i')+30,date('s'));
        $day=date("l");
        $day =substr($day,0,-3);
        $Random=rand(11111,99999);
        $unique= $day.date('d_m_Y_h_i_sA', $time_now);
        $unique= str_replace('_','',$unique).$Random;
        mysqli_query($mysqli,"INSERT into orders(order_process_id,product_list,product_price,username,payable_amount) VALUES('$unique','$productDetails','$amount','$RealUsername','$amount')");
        $_SESSION['order_process_no']=$unique;
        // echo  $RealUsername.'<br>'.$unique.'<br>'.$_SESSION['order_process_no'].'<br>'.$productDetails.'<br>'.$username.'<br>'.$amount;
        echo "<script>window.location.href='PayUMoney_form.php';</script>";
} 
$mysqli->close(); 
}         



    

    if(isset($_POST['CartButtonRemoveAll'])) {
        removeAll();
    }
    if(isset($_POST['CartButtonBuyAll'])) {
        BuyAll();
    }
    if(isset($_POST['CartQuantityIncrement'])) {
        incrementProducts();
    }
    if(isset($_POST['CartQuantityDecrement'])) {
        decrementProducts();
    }
    if(isset($_POST['CartButtonRemove'])) {
        removefromCart();
    }
    if(isset($_POST['CartButtonBuy'])) {
        Buy();
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