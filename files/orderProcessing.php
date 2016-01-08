<?php
    require_once("includes/header.php");

    unset($_SESSION["basket"]);

    $oBasket = new Basket();
          $_SESSION["basket"] = $oBasket; // creates cart when a session starts

?>
 
<h1 class="textAlignCenter">Order Received!</h1>
<div class="mainForms userBox clearBoth sixteenColumns marginRight10 marginBottom50 marginLeft10 selfClear">
    <h2 class="paddingTop10 paddingBottom20 textAlignCenter">Your Order is Now Processing</h2>
    <p class="textAlignCenter marginBottom50">Once your order has been shipped, we will notify you via the email address that is listed in your account details.</p>
    <div class="blueButton bgBlue textAlignCenter"><a href="index.php">Home</a></div>    
    
</div>

<?php
    require_once("includes/footerAdmin.php");
?>
           
           
           
       
   