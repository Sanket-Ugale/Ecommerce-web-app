<!DOCTYPE html>
<html lang="en">
  <head>
      
        <link rel="icon" type="image/png" href="images/logo3.png">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Noble Intermediates | About</title>
    <s><link rel="stylesheet" href="CSS/footer.css"></s>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">-->
    <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css">-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>-->
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="stylesheet" href="CSS/about.css">
    <script src="script.js"></script>
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
if(!isset($_SESSION['logged_in'])){
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

    <!-- <header>
      <nav class="main-nav">
        <input type="checkbox" id="check" />
        <label for="check" class="menu-btn">
          <i class="fas fa-bars"></i>
        </label>
        <img class="imageLogo" src="images/logo.png" alt="" srcset="Noble Intermediates Private Limited">
        <ul class="navlinks">
          <li><a href="products.php">Products</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.php" class="contact">Contact</a></li>
          <li><a href="login.php" id="login" class="login">Login</a></li>
          <li><a href="signUp.php" id="signup" class="login">Register</a></li>
          <li><a href="logout.php" id="profile" class="login"><i class="fa-solid fa-user"></i></a></li>  
        </ul>
      </nav>
    </header> -->
    <div data-aos="zoom-out-up">
    <img src="images/team2.jpg" alt="" class="Parahead">
    <div class="container">
      
      <h1 class="containerTitle"><center>About Us</center></h1>
      <p>We started as “Noble Chemicals” has now promoted to “Noble Intermediates Pvt. Ltd.” A milestone crossed and indeed an achievement for us! Established in the year 2003. We, “Noble Intermediates Pvt. Ltd.”, are one of the most distinguished manufacturers and suppliers of Whole range of Antimony salts like Antimony Trichloride, Antimony Pentasulfide, Antimony Trisulfide, and other Industrial Chemicals. Our range also includes Antimony Pottasium Tartarate, Potassium Pyroantimonate, Tertiary Butyl HydroPeroxide . Our range of chemicals is very significant in terms of various process and have their commercial value. Meeting the requirements of numerous industries, the chemicals we offer are effective, accurate in composition and have long shelf life.</p>
      <p>We have built a highly sophisticated laboratory equipped with modern tools and instruments to formulate environment friendly chemicals. All the chemicals are processed with fine ingredients procured from some of the renowned certified vendors of the market. Our professional team brings about the production process to deliver optimum quality chemicals that adheres to international standards. Moreover, we have the world-class facility to store the array of chemicals with proper safety. This unit is managed by our highly skilled and experienced professionals to keep it clean and hygienic. Further, we have been able to mark our presence in the market due to our eco-friendly chemicals, cost-effectiveness and ethical business deals.</p>
      <p>We have progressed immensely under the proficient guidance of our mentor, 'Mr. Shashank Sinalkar', who has a vast domain knowledge. He has led the organization to the pinnacle of success within a very short period of time.</p>
    </div>
    </div>
    
    <div data-aos="zoom-out-left">
    <img src="images/energy.png" alt="" class="Parahead">
    <div class="container">
      <h1 class="containerTitle"><center>Basic Information</center></h1>
      <p><center>Nature of Business - Manufacturers and Suppliers</center></p>
      <p><center>Registered Address - Plot No: A-36, Behind State Bank of India, MIDC, Badlapur (E), Maharashtra, India - 421 503</center></p>
      <p><center></p>Establishment year - 2003</center></p>
    </div>
    </div>

    <div data-aos="zoom-out-right">
    <img src="images/material.png" alt="" class="Parahead">
    <div class="container">
      <h1 class="containerTitle"><center>Quality Assurance</center></h1>
      <p>We have directed all our efforts in providing quality products to the clients. Our organization adheres to strict quality policy to deliver a non-toxic and eco-friendly Industrial Chemicals. All our chemicals are processed with optimum quality ingredients as per the norms and guidelines of the industry. We have employed a team of quality auditors, which is responsible to check the quality of the chemicals on various parameters. Further, at our in-house laboratory, we check the quality of the chemicals using the latest tools and instruments. Moreover, we also pack the chemicals in quality packaging material to avoid spillage during storage and transportation.</p>
    </div>
    </div>
    
    <div data-aos="flip-up">
    <img src="images/mechanical.png" alt="" class="Parahead">
    <div class="container">
      <h1 class="containerTitle"><center>Client Satisfaction</center></h1>
      <p>Being a client-centric organization, we aim to deliver qualitative range of products to the clients. Our range of Trichloride, Trisulfide, TBHP and other Industrial Chemicals is offered to the clients in required specification to meet their various application requirements. We further capable to fulfill the bulk requirements due to the use of advance methodology and machines. We offer our products at industry leading prices and ensure that the consignments are delivered right on time without any delays. We also make sure that these are delivered to the clients with complete safety. Further, the easy payment modes, transparent deals have helped we helped us garner huge client base across the nation.</p>
    </div>
    </div>

    <div data-aos="zoom-out-down">
    <img src="images/mechanical1.png" alt="" class="Parahead">
    <div class="container">
      <h1 class="containerTitle"><center>Our Team</center></h1>
      <p>Empowered by a team of hard working professionals, we have been able to meet the goal of the organization. Our professionals with their vast industry experience form the backbone of our organization. They help us carry out the entire production process in a smooth manner. With their support, we have been able to meet the bulk requirements of the clients within a stipulated time frame. These professionals coordinates each other in delivering optimum quality chemicals to the clients. Moreover, we provide training on regular basis to keep the professionals up-to-date as per the latest advancement.</p>
      <p><b>Our team comprises the following members :</b></p>
      <p>>> Chemical engineers</p>
      <p>>> Quality controllers</p>
      <p>>> Warehousr and packaging personnel</p>
      <p>>> Sales and marketing executives</p>
    </div>
    </div>

    <div data-aos="flip-down">
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
        </div>
        <div data-aos="flip-up">

        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15075.563815812386!2d73.24338!3d19.15625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb8bf22317f624df1!2sNOBLE%20INTERMEDIATES%20PRIVATE%20LIMITED!5e0!3m2!1sen!2sin!4v1645932768419!5m2!1sen!2sin" width="90%" height="250px" style="border:0; margin-top:50px; margin-left:5%" allowfullscreen="" loading="lazy"></iframe>
          
     <div class="copy" style="color:black">
    &copy; 2022 nobleintermediates
    </div>
    <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
  

    <!-- This site is converting visitors into subscribers and customers with https://respond.io --><script id="respondio__widget" src="https://cdn.respond.io/webchat/widget/widget.js?cId=aa1efbbb9388135de756a9279aa7cc12b52ceaa64cd965fca0982d568344fa58"></script><!-- https://respond.io -->
  </body>
</html>