<?php
session_start();
if(!isset($_SESSION['logged_in'])){
	header('location:login.php');
	die();
}
if(!isset($_SESSION['order_process_no'])){
	header('location:cart2.php');
	die();
}
include 'conn.php';
$msg='';
$orderProcessId=$_SESSION['order_process_no'];
$UserOrderData = mysqli_query($mysqli,"SELECT * FROM orders WHERE order_process_id='$orderProcessId'");
$UserOrderData=mysqli_fetch_assoc($UserOrderData);
$name=$UserOrderData['username'];
$productList=$UserOrderData['product_list'];
$payableAmount=$UserOrderData['payable_amount'];
$UserData = mysqli_query($mysqli,"SELECT * FROM user WHERE username='$name'");
$UserData=mysqli_fetch_assoc($UserData);
$email=$UserData['email'];
$contact=$UserData['contact'];
$Useraddress=$UserData['address'];

$failure='http://nobleintermediates.000webhostapp.com/failure.php';
$success='http://nobleintermediates.000webhostapp.com/success.php';
$MERCHANT_KEY = "";
$SALT = "";
// Merchant Key and Salt as provided by Payu.

// $PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noble Intermediates Private Limited</title>
    <link rel="icon" type="image/png" href="images/logo3.png">
  </head>
  <style>
        body{
            
            /* background-image: url(images/bottles.jpg); */
            color:white;
            padding: auto;
            background-size: auto;
            background-color: #0cbaba;
            background-image: linear-gradient(315deg, #0cbaba 0%, #380036 74%);

            /* background: rgb(34,193,195);
            background: linear-gradient(112deg, rgba(34,193,195,1) 0%, rgba(45,253,151,1) 100%); */
            /* background-repeat: no-repeat; */
            /* background: cover; */
            font-family: 'Times New Roman', Times, serif;

        }
        .main{
            text-align: center;
            color: rgb(0, 0, 0);
            background-color: rgb(255, 255, 255, 0.7);
            padding: 20px;
            font-size:large;
            /* min-width: 90px; */
            max-width: 800px;
            border: 2px solid white;
            border-radius: 10px;
        }
        .Maintitle{
            font-size:xx-large;
            font-weight: 500;
        }
        .title{
            float: left;
            padding-left: 30px;
        }
        .inputField input{
          font-size: medium;
            background-color: rgba(255, 255, 255, 0.41);
            margin-top: 3px;
            height: 28px;
            border: 0.8px solid black;
            outline-color: rgba(104, 236, 236, 0.534);
        }
        .button input{            
            margin-top: 20px;
            padding-top: 8px;
            padding-bottom: 8px;
            border: none;
            font-family: 'Times New Roman', Times, serif;
            font-size:large;
            border-radius: 8px;
            background-color: rgb(50, 156, 156);
            margin-bottom: 10px;
            width:100%;
            cursor: pointer;
        }
        .button input:hover{
            background-color: rgb(63, 183, 199);
        }
        .inputFieldAddress input{
          font-size: large;
            background-color: rgba(255, 255, 255, 0.41);
            height: 30px;
            border: 0.8px solid black;
            outline-color: rgba(104, 236, 236, 0.534);
        }        
        .inputField_Productdetails{
            text-align: justify;
            padding-left: 20px;
            padding-right: 20px;
        }        
        .productDetails{
            border: 0.8px solid black;
            padding: 8px;
            margin-left: 15px;
            margin-right: 15px;
            min-height: 50px;
            min-width: 200px;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.41);
        }        
        
            @media screen and (min-width:1200px){
                .main{
                    margin-top: 80px;
                margin-left: 330px;
                margin-right: 330px;
            }
        }
            @media screen and (min-width:1000px){
               
                .main{
                    margin-top: 70px;
                margin-left: 280px;
                margin-right: 280px;
                padding: 20px;
            }
            /* .parent{
            margin-left: 15%;
            margin-right: 15%;
        } */
        }
            @media screen and (min-width:900px){
               
                .main{
                    margin-top: 60px;
                margin-left: 220px;
                margin-right: 220px;
                padding: 20px;
            }
        }
            @media screen and (min-width:800px){
                .main{
                    margin-top: 50px;
                margin-left: 200px;
                margin-right: 200px;
                padding: 20px;
            }
        }
            @media screen and (min-width:600px){
                .main{      
                    margin-top: 50px;              
                margin-left: 180px;
                margin-right: 180px;
                padding: 10px;
            }
        }
            @media screen and (min-width:400px){
                /* body{
                    width: 90%;
                } */
                .main{
                    margin-top: 40px;
                margin-left: 80px;
                margin-right: 80px;
                padding: 10px;
            }
                .productDetails{
                margin-left: 15px;
                margin-right: 15px;
                min-height: 50px;
                min-width: 150px;
            }
        }
        @media screen and (min-width:250px){
                /* body{
                    width: 90%;
                } */
                .main{
                margin-left: 40px;
                margin-right: 40px;
                padding: 10px;
            }
                .productDetails{
                margin-left: 15px;
                margin-right: 15px;
                min-height: 50px;
                min-width: 50px;
            }
        }
    </style>
    <center>
    <body onload="submitPayuForm()">
    <!-- <div class="parent"> -->
        <div class="main">
    <?php if($formError) { ?>
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>     
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
                <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
                <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
                <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
                    <input name="amount" type="hidden" value="<?php echo $payableAmount?>" />
    
                    <span class="Maintitle">
                        <!-- Title -->
                    </span><br>
                    <span class="title">
                        Name
                    </span>
                    <span class="inputField">
                        <input name="firstname" id="firstname" value="<?php echo $name ?>" />
                    </span><br><br>
    
                    <span class="title">
                        Email
                    </span>
                    <span class="inputField">
                        <input name="email" id="email" value="<?php echo $email ?>" />
                    </span><br><br>
    
                    <span class="title">
                        Phone
                    </span>
                    <span class="inputField">
                        <input name="phone" value="<?php echo $contact ?>" />
                    </span><br><br>
    
                    <span class="title">
                        Payable Amount
                    </span>
                    <span class="inputField">
                        <input type="text" disabled value="<?php echo $payableAmount?>" >
                    </span><br><br>
    
                    <span class="title">
                        Product Details
                    </span>
                    <input type="hidden" name="productinfo" value="<?php echo $productList?>">
                    <span class="inputField_Productdetails">
                        <center>
                            <div class="productDetails">
                                <?php echo $productList?>
                                </div>
                        </center>
                    </span><br>       
                    <!-- <td>Success URI: </td> -->
                    <input name="surl" type="hidden" value="<?php echo $success?>" size="64" />
             
                    <!-- <td>Failure URI: </td> -->
                    <input name="furl" type="hidden" value="<?php echo $failure?>" size="64" />
        
                    <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
    
                    <span class="title">
                        Address
                    </span>
                    
                    <span class="inputFieldAddress">
                        <input name="address" required value="<?php echo $Useraddress ?>" />
                        <?php if(!$hash) { ?>
                    </span>
                    
                      <br>
                      <span class="button">
                        <input type="submit" value="Procced to Pay" /><br>
                        <?php } 
                        $mysqli->close();
                        ?>
                      </span>
                     
              </form>
    
    
        </div>
        <style>
       div.disclaimer
    {
        display:none;
    }
  </style>
  </body>
  </center>
</html>
