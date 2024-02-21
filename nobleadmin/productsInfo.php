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
    <link rel="stylesheet" href="CSS/productsInfo.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="icon" type="image/png" href="logo3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <title>Noble Intermediates Admin | Products</title>
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
    <div class="productInfo">
        <section>
        <strong><h1 class="ProductDetails">Products </h1></strong>
        <a href="addproduct.php" class="AddProduct"><i class="fa-solid fa-plus"></i>  Add Product</a>
        <!-- TABLE CONSTRUCTION-->
        <table>
        <tr class="tableHead">
                <th>Product Id</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Chemical Name</th>
                <th>Minimum Order Quantity</th>
                <th>Purity</th>
                <th>storage</th>
                <th>Grade</th>
                <th>Form</th>
                <th>Unit</th> 
                <th>Price</th>
                <th colspan='3'>Action</th>
                <!-- <th>Delete</th> -->
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php  
            include 'conn.php';
            $result = mysqli_query($mysqli, "select * from product");
            if (mysqli_num_rows($result) > 0) {
                while($rows=mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo "<td>" . $rows["product_id"] . "</td>";
                    echo "<td>" . $rows["product_image"] . "</td>";
                    echo "<td>" . $rows["product_name"] . "</td>";
                    echo "<td>" . $rows["product_category"] . "</td>";
                    echo "<td>" . $rows["chemical_name"] . "</td>";
                    echo "<td>" . $rows["Minimum_order_quantity"] . "</td>";
                    echo "<td>" . $rows["purity"] . "</td>";
                    echo "<td>" . $rows["storage"] . "</td>";
                    echo "<td>" . $rows["grade"] . "</td>";
                    echo "<td>" . $rows["form"] . "</td>";
                    echo "<td>" . $rows["unit"] . "</td>";
                    echo "<td>" . $rows["product_price"] . "</td>";    
                    echo "<td><form method='post'><input type='hidden' name='productId' value='".$rows["product_id"]."'><button name='CheckAvailability' class='CheckAvailability' type='submit'>".$rows["product_availability"]."</button></form></td>";                  

                    // echo "<td> <a class='UpdateButton' href=update.php?productName=". str_replace(' ','_',$rows["product_name"]) .">Update</a></td>";
                    echo "<td><form method='post'><input type='hidden' name='productName' value='".str_replace(' ','_',$rows["product_name"])."'><button name='UpdateProduct' class='UpdateButton' type='submit'>Update</button></form></td>";
                    // print "<td><a class='DeleteButton' href=delete.php?productName=".str_replace(' ','_',$rows["product_name"]).">Delete</a></td>";
                    // echo "<td><form method='POST' class='DeleteButton' action='delete.php?productName=".urlencode(str_replace(' ','_',$rows["product_name"])).">Delete</td>";
                    echo "<td><form method='post' action='delete.php'><input type='hidden' name='productName' value='".str_replace(' ','_',$rows["product_name"])."'><button class='DeleteButton' type='submit'>Delete</button></form></td>";
                    // echo " </td>";
                    echo '</tr>';
                }
            } else {
                echo "0 results";
            }
            function functio_n(){
                include 'conn.php';
                $productName=mysqli_real_escape_string($mysqli,$_POST['productName']);
                $_SESSION['product_name']=$productName;
                echo "<script>window.location.href='update.php';</script>";
            }
               if(isset($_POST['UpdateProduct'])){
                   functio_n();
               }
                         if(isset($_POST['CheckAvailability'])){
                Availability();
               }
               function Availability(){
                include 'conn.php';
                $productID=mysqli_real_escape_string($mysqli,$_POST['productId']);
                $CheckingAvailability=mysqli_query($mysqli,"SELECT product_availability FROM product WHERE product_id='$productID'");
                $CheckingAvailabilityrow=mysqli_fetch_assoc($CheckingAvailability);
                if($CheckingAvailabilityrow['product_availability']=='unavailable'){
                    mysqli_query($mysqli,"UPDATE product set product_availability= 'available' WHERE product_id='$productID'");
                }
                else{
                    mysqli_query($mysqli,"UPDATE product set product_availability= 'unavailable' WHERE product_id='$productID'");
                }
                echo "<script>window.location.href='productsInfo.php';</script>";
                $mysqli->close();
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