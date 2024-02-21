<?php
// // Include the database configuration file
// include 'conn.php';

// // Get images from the database
// $query = $mysqli->query("SELECT * FROM product");

// if($query->num_rows > 0){
//     while($row = $query->fetch_assoc()){
//         $imageURL = 'uploads/'.$row["product_image"];
// ?>
//    
 <!-- <img src="
 <?php 
//  echo $imageURL; ?>" alt="" height="100%" width="auto" /> -->
 <?php
//  }
// }else{ ?>
//    
 <!-- <p>No image(s) found...</p> -->
// <?php 
// }
//  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- <table class="table table-bordered">  
                     <tr>  
                          <th>Image</th>  
                     </tr>  
                <?php  
                // $connect = mysqli_connect("localhost", "root", "", "website");  
                // $query = "SELECT * FROM product";  
                // $result = mysqli_query($connect, $query);  
                // while($row = mysqli_fetch_array($result))  
                // {  
                //      echo '  
                //           <tr>  
                //                <td>  
                //                     <img src="data:image/jpg;base64,'.base64_encode($row['product_image'] ).'" height="auto" width="100%" class="img-thumnail" />  
                //                </td>  
                //           </tr>  
                //      ';  
                // }  
                ?>  
                </table>   -->
                <?php 
// Include the database configuration file  
require_once 'conn.php'; 
 
// Get image data from database 
$result = $mysqli->query("SELECT product_image FROM product"); 
?>

<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){ ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['product_image']); ?>" /> 
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>
<style>
       div.disclaimer
    {
        display:none;
    }
  </style>
</body>
</html>
