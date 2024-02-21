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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/userdata.css">
    <link rel="stylesheet" href="CSS/style2.css">
    <link rel="icon" type="image/png" href="logo3.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <title>User Details</title>
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
        <section>
        <h1 class="UserDetails">User Details</h1>
        <!-- TABLE CONSTRUCTION-->
        <table>
        <tr class="tableHead">
                <th>Username</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Call</th>
                <th>Send Mail</th>
                <th>Past History</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
            include 'conn.php';
            $result = mysqli_query($mysqli, "select * from user");
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($rows=mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo "<td>" . $rows["username"] . "</td>";
                    echo "<td>" . $rows["email"] . "</td>";
                    echo "<td>" . $rows["contact"] . "</td>";
                    echo "<td>" . $rows["address"] . "</td>";                 
                    echo "<td> <a class='Call' href=tel:".$rows["contact"]."><i id='logos' class='fa-solid fa-phone'></i></a></td>";
                    echo "<td> <a class='Email' href=mailto:".$rows["email"]."><i id='logos' class='fa-solid fa-envelope'></i></a></td>";
                    echo "<td> <form method='post' action='history.php'><input type='hidden' name='HuserName' value='".str_replace(' ','_',$rows['username'])."'><input type='hidden' name='Hemail' value='".$rows['email']."'><button class='HistoryButton' type='submit'><i class='fas fa-file-invoice'></i></button></form></td>";                                       
                    echo '</tr>';
                }
            } else {
            //     echo "0 results";
            }
               
             ?>
        </table>
    </section>
    </div>
    <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>