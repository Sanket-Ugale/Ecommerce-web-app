<?php
session_start();
if(isset($_SESSION['logged_in'])){
	header('location:products.php');
	die();
}
// elseif(isset($_SESSION['logged_in'])){
//     echo '<script>myfunction();</script>';
// }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Noble Intermediates Private Limited</title>
    <link rel="stylesheet" href="CSS/style2.css" />
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/products.css">
    <script src="script.js"></script>
    <link rel="icon" type="image/png" href="images/logo3.png"> 
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>  
  </head>
  <?php
  echo "<body onLoad='myfunction();'>
  <script>
  //     function myfunction(){
  //         document.getElementById('login').style.display = 'none';
  //         document.getElementById('signup').style.display = 'none';
          
  //     }
  </script>"
  ?>
    </script>
    <div id="loader" class="center"></div>

    
    <header>
    <a href="index.php"><img class="imageLogo" src="images/logo.png" alt="Noble Intermediates Private Limited"></a>
            <input type="checkbox" id="menu-bar">
            <label for="menu-bar" class="menu-bar">
                <i class="fas fa-bars"></i>
              </label>

            <nav class="navbar">
                <ul>
                    <li><a>Products <i class="fa-solid fa-chevron-down"></i></a>
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
                </ul>
            </nav>
        </header>
        <div class="row">
        <?php
        include 'conn.php';

        $result = mysqli_query($mysqli, "select * from product");
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($rows=mysqli_fetch_assoc($result))
                {
                echo "<div class='column'>";
                echo "<img class='productImage' src='nobleadmin/".$rows["product_image"]."' alt='".$rows["product_name"]."'>";
                echo "<div class='card'>";
                // echo "<img class='productImage' src='nobleadmin/".$rows["product_image"]."' alt='".$rows["product_name"]."'>";
                echo "<p class='ProductName'>" . $rows["product_name"] . "</p><br>";
                echo "<p class='productInfo'><span class='productInfoTitle'> Chemical Name: </span>".$rows["chemical_name"]."</p>";
                echo "<p class='productInfo'><span class='productInfoTitle'>Minimum order Quantity: </span>".$rows["Minimum_order_quantity"]."</p>";
                echo "<p class='productInfo'><span class='productInfoTitle'>Purity: </span>".$rows["purity"]."</p>";
                echo "<p class='productInfo'><span class='productInfoTitle'>Storage: </span>".$rows["storage"]."</p>";
                echo "<p class='productInfo'><span class='productInfoTitle'>Grade: </span>".$rows["grade"]."</p>";
                echo "<p class='productInfo'><span class='productInfoTitle'>State: </span>".$rows["form"]."</p>";
                echo "<p class='productInfo Cardprice'><span class='productInfoTitle'></span>".$rows["product_price"]."<i class='fa-solid fa-indian-rupee-sign'></i>/ ".$rows["unit"]."</p>";
                if($rows["product_availability"]=='unavailable'){
                    echo "<button class='Productbutton' style='color:red; font-size:18px; font-weight:bold;' disabled>Out Of Stock</button>";
                }
                else{
                    echo "<button class='Productbutton'><a href='products.php' class='IndexProductbutton'>Add to Cart</a></button>";
                }
                // echo "<button class='Productbutton' type='submit' onclick='products.php'>Add to Cart</button>";                    
                echo "</div>";
                echo "</div>";
            }
        }
        else{
            echo "";
        }
        $mysqli->close();
        ?>
    </div>
    <div class="footer2">

        <div class="row2">
            <div class="column2">
                <span class="heading2">
                    OUR OFFICE
                </span><br><br>
                <span class="content">
                    602, Dwarka Mai Apartment, Near Old Indian oil petrol pump, Katrap, Kalyan - Karjat Highway, Badlapur (E), Maharashtra, India - 421503
                </span>
            </div>
    
            <div class="column2">
                <span class="heading2">
                    FACTORY ADDRESS
                </span><br><br>
                <span class="content">
                    Plot No: A-36, Behind State Bank of India, MIDC, Badlapur (E), Maharashtra, India - 421 503
                </span>
            </div>
    
            <div class="column2">
                <span class="heading2">
                    CALL US
                </span><br><br>
                <span class="content">
                    <a href="tel:+91-7888024770">+91-7888024770</a>
                </span>
            </div>
    
            <div class="column2">
                <span class="heading2">
                    EMAIL US
                </span><br><br>
                <span class="content">
                <a href="mailto: info@nobleintermediates.com">info@nobleintermediates.com</a><br>
                    <a href="mailto: marketing@nobleintermediates.com">marketing@nobleintermediates.com</a>
                </span>
            </div>
        </div>
        <hr class="HRLine">
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

    <div class="copy" style="color:black;">
    &copy; 2022 nobleintermediates
    </div>
    </div>
    <!-- This site is converting visitors into subscribers and customers with https://respond.io -->
    <script id="respondio__widget" src="https://cdn.respond.io/webchat/widget/widget.js?cId=aa1efbbb9388135de756a9279aa7cc12b52ceaa64cd965fca0982d568344fa58"></script>
    <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
  </body>
</html>