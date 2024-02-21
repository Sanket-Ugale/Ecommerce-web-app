<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])){
	header('location:login.php');
	die();
}
elseif(isset($_SESSION['admin_logged_in'])){
    echo '<script>myfunction();</script>';
}

include('conn.php');
$product_name=$_SESSION['product_name'];
// $product_name=mysqli_real_escape_string($mysqli,$_POST['productName']);
$product_name=str_replace('_',' ',$product_name);
$query = mysqli_query($mysqli,"SELECT * from product where product_name='$product_name'");
// echo $query; 
$row = mysqli_fetch_assoc($query);
$productNumber=$row['product_id'];
$msg="";
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    // $Product__Image= addslashes(file_get_contents($_FILES["ProductImage"]["tmp_name"]));
    // $productid=mysqli_real_escape_string($mysqli,$_POST['productId']);
    $productname=mysqli_real_escape_string($mysqli,$_POST['productName']);
    $prductCategory=mysqli_real_escape_string($mysqli,$_POST['prductCategory']);
    $chemicalname=mysqli_real_escape_string($mysqli,$_POST['chemicalName']);
    $Minimumorder_quantity=mysqli_real_escape_string($mysqli,$_POST['Quantity']);
    $purit_y=mysqli_real_escape_string($mysqli,$_POST['Purity']);
    $storag_e=mysqli_real_escape_string($mysqli,$_POST['Storage']);
    $grad_e=mysqli_real_escape_string($mysqli,$_POST['Grade']);
    $for_m=mysqli_real_escape_string($mysqli,$_POST['productForm']);
    $productprice=mysqli_real_escape_string($mysqli,$_POST['productPrice']);
    $uni_t=mysqli_real_escape_string($mysqli,$_POST['Unit']);
    mysqli_query($mysqli,"UPDATE product SET product_name='$productname', product_category='$prductCategory', chemical_name='$chemicalname', Minimum_order_quantity='$Minimumorder_quantity', purity='$purit_y', storage='$storag_e', grade='$grad_e', form='$for_m', product_price='$productprice', unit='$uni_t' WHERE product_id='$productNumber'");
    // mysqli_query($mysqli,"UPDATE product(product_name, product_category, chemical_name, Minimum_order_quantity, purity, storage, grade, form, product_price, unit) VALUES ('$productname', '$prductCategory', '$chemicalname','$Minimumorder_quantity','$purit_y','$storag_e','$grad_e','$for_m','$productprice','$uni_t') WHERE product_id='$productNumber'");
    $msg="Product updated successfully";
    echo "<script>window.location.href='productsInfo.php';</script>";
  } else {
    $msg= "Sorry, there was an error in updating product.";
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/loginstyle.css">
    <link rel="icon" type="image/png" href="logo3.png">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <title>Noble Intermediates Admin | Update Product</title>
</head>
<style>
   input[type=file]::file-selector-button {
  /* border: 2px solid #ff7700; */
  margin-top: 10px;
  border: none;
  padding: .2em .4em;
  border-radius: .2em;
  background-color: rgb(0, 122, 116);
  transition: 1s;
}

input[type=file]::file-selector-button:hover {
  background-color: rgb(0, 235, 219);
  /* border: 2px solid black; */
}
#productForm{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
  z-index: -1;
}
 #productForm:focus{
  border-color: #16a085;
  box-shadow: inset 0px 0px 1px 1px orange
}
#Unit{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
  z-index: -1;
}
 #Unit:focus{
  border-color: #16a085;
  box-shadow: inset 0px 0px 1px 1px orange
}
#category{
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 60px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 16px;
  transition: all 0.3s ease;
  z-index: -1;
}
 #category:focus{
  border-color: #16a085;
  box-shadow: inset 0px 0px 1px 1px orange
}
</style>
<?php
  echo "<body onLoad='myfunction();'>
  <script>
      function myfunction(){
          document.getElementById('login').style.display = 'none';
          
      }
  </script>"
  ?>
<!-- <div id="loader" class="center"></div> -->
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
        <ul class="navlinks">
          <li><a href="productsInfo.php">Products</a>
          </li>
          <li><a href="orders.php">Orders</a></li>
          <li><a href="userdata.php" class="contact">Users</a></li>
          <li><a href="https://app.respond.io/space/78337/message" target="_blank">Messages</a></li>
          <li><a href="login.php" id="login" class="login">Login</a></li>
          <li><a href="signup.php" id="signup" class="login">Register</a></li>
          <li><a href="logout.php" id="signup" class="login">Logout</a></li>           
        </ul>
      </nav>
    </header> -->
    <div class="container">
        <div class="wrapper">
          <div class="title"><span>Update Product</span></div>
          <form method="post"  enctype="multipart/form-data">
            <!-- <div class="row">
                <i class="fa-solid fa-image"></i>
              <input class="image" accept="image/*" name="ProductImage" type="file" placeholder="Upload Image" required>
            </div> -->
            <div class="row">
            <i class="fa-regular fa-hashtag"></i>
              <input name="productId" type="text" placeholder="Enter Product Id" value="<?php echo $productNumber?>" disabled required>
            </div>
            <div class="row">
                <i class="fa-solid fa-file-signature"></i>
              <input name="productName" type="text" placeholder="Enter Product Name" value="<?php echo $row['product_name'];?>" required>
            </div>
            <div class="row">
            <i class="fa-solid fa-t" style="margin-top: 18px;"></i>Select Category
            <input type="text" name="prductCategory" list="prductCategory">
            <datalist id="prductCategory">
                    <option id="productFormTitle" value="Select Product Category" disabled>
                    <option value="Chemical Lumps">
                    <option value="Chemical Power">
                    <option value="Chemical Solution">
                    <option value="Antimony Salts">
                    <option value="Antimony Salts">
                    <option value="Other">
                </datalist>
                </div>
            
            <div class="row" style="margin-top: 35px;">
                <i class="fa-solid fa-vial"></i>
                <input name="chemicalName" type="text" placeholder="Enter Chemical Name" value="<?php echo $row['chemical_name'];?>" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-maximize"></i>
                <input name="Quantity" type="text" placeholder="Minimum Order Quantity" value="<?php echo $row['Minimum_order_quantity'];?>" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-percent"></i>
                <input name="Purity" type="number" placeholder="Purity %" value="<?php echo $row['purity'];?>" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-box"></i>
                <input name="Storage" type="text" placeholder="Storage" value="<?php echo $row['storage'];?>" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-industry"></i>
                <input name="Grade" type="text" placeholder="Grade" value="<?php echo $row['grade'];?>" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-flask "></i>
                <select name="productForm" id="productForm">
                    <option id="productFormTitle" value="Product Form" disabled>Select Product Form</option>
                    <option value="Solid">Solid</option>
                    <option value="Liquid">Liquid</option>
                    <option value="Gas">Gas</option>
                    <option value="Powder">Powder</option>
                </select>
            </div>
            <div class="row">
                <i class="fa-solid fa-indian-rupee-sign"></i>
                <input name="productPrice" type="number" placeholder="Enter Product Price" value="<?php echo $row['product_price'];?>" required>
            </div>
            <div class="row">
                <i class="fa-solid fa-scale-unbalanced-flip"></i>
                <select name="Unit" id="Unit">
                    <option id="Unit" disabled>Select Unit according to price</option>
                    <option value="Kilograms">Kilogram</option>
                    <option value="grams">grams</option>
                    <option value="Liter">Liter</option>                    
                    <option value="Tonne">Tonne</option>
                </select>
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
      </div>   
      <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>