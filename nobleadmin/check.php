
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Intermediates Private Limited</title>
    <style>
        body{
            background-color: rgb(0, 109, 91);
            color: white;
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
        }
        a.login{
            color: red;
            font-size: larger;
            font-weight: bold;
        }
        .verified{
            font-size:xx-large;
        }
    </style>
</head>
<body>
<?php
include('conn.php');

    $id=mysqli_real_escape_string($mysqli,$_GET['id']);
    mysqli_query($mysqli,"UPDATE admin SET verification_status='1' WHERE verification_id='$id'");
    echo "<span class='verified'>Your account verified</span>";

?>
    <h3>Go to</h3>
<a class="login" href="login.php">Login</a>
</body>
</html>
