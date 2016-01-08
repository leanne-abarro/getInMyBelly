<?php
    require_once("includes/header.php");
    require_once("includes/form.php");
    require_once("includes/order.php");


    $oBasket = $_SESSION["basket"];       

    $iProductID = 1;
    
      if(isset($_GET["ProductID"])){
	  	$iProductID = $_GET["ProductID"];
	  }
    
	$oProduct = new Product();
	$oProduct ->load($iProductID);

    $oCustomer = new User();
    $oCustomer -> load($_SESSION["UserID"]);

 
     

        echo View::renderCheckoutBasket ($oBasket);

// delivery and billing payment form

    $oDeliveryPayForm = new Form();

    if (isset($_POST["checkout"])){

            $oDeliveryPayForm -> data = $_POST;
            
            $oDeliveryPayForm -> checkFilled("name");
            
            if (!isset($_POST["deliveryAdd"])){
                $oDeliveryPayForm -> checkFilled("delivery");
            }

            if (!isset($_POST["billingAdd"])){
                $oDeliveryPayForm -> checkFilled("billing");
            }

            $oDeliveryPayForm -> checkFilled("paymentType");
            $oDeliveryPayForm -> checkFilled("accountName");
            $oDeliveryPayForm -> checkFilled("ccNumber");
            $oDeliveryPayForm -> checkFilled("expiry");
            $oDeliveryPayForm -> checkFilled("security");

            if ($oDeliveryPayForm -> valid == true){
                
                $oOrder = new Order();
                
                $oOrder -> orderStatus = "Processing";
                $oOrder -> recipientName = $_POST["name"];

                if (isset($_POST["deliveryAdd"])){
                  $oOrder -> delivery = $oCustomer -> address;
                } else {
                  $oOrder -> delivery = $_POST["delivery"];
                }

                if (isset($_POST["billingAdd"])){
                    
                    if (isset($_POST["deliveryAdd"])){
                        $oOrder -> billing = $oCustomer -> address;

                    } else {
                        $oOrder -> billing = $oOrder -> delivery = $_POST["delivery"];
                    }
                    
                } else {
                  $oOrder -> billing = $_POST["billing"];
                }

                
                $oOrder -> payment = $_POST["paymentType"];
                $oOrder -> accountName = $_POST["accountName"];
                $oOrder -> cardNumber = $_POST["ccNumber"];
                $oOrder -> expiry = $_POST["expiry"];
                $oOrder -> security = $_POST["security"];
                $oOrder -> userID = $oCustomer -> userID;
                
                $oOrder -> save();
                
                // redirect after adding new page successfully to that new location

                  header("Location:orderProcessing.php"); // will prompt message to come up
                  exit; // terminates request
                
            }
        }

    // html form markup
    $oDeliveryPayForm -> makeHeader3("Delivery &amp; Billing Address");
    $oDeliveryPayForm -> makeInput("name","Name","inputHeight");
    $oDeliveryPayForm -> makeInput("delivery","Delivery Address","inputHeight");
    $oDeliveryPayForm -> makeCheckBox("deliveryAdd","* use address in my account details");
    $oDeliveryPayForm -> makeInput ("billing","Billing Address","inputHeight");
    $oDeliveryPayForm -> makeCheckBox("billingAdd","* same as delivery address");
    $oDeliveryPayForm -> makeHeader3("Payment Information");
    $oDeliveryPayForm -> makeInput("paymentType","Payment Method","inputHeight");
    $oDeliveryPayForm -> makeInput("accountName","Account Name","inputHeight");
    $oDeliveryPayForm -> makeInput("ccNumber","Credit Card Number","inputHeight");
    $oDeliveryPayForm -> makeInput("expiry","Expiry Date","inputHeight inputQuarter marginRight10 floatLeft");
    $oDeliveryPayForm -> makeInput("security","Security","inputHeight inputQuarter floatLeft");
    $oDeliveryPayForm -> makeSubmit("checkout","CheckOut","clearBoth blueButton bgBlue floatRight selfClear");
?>           
                   
            <!-- delivery and billing -->
            <div class="checkOutForm sixteen columns mainForms floatLeft marginBottom30">
                
                <!-- name -->
                <?php 
                    echo $oDeliveryPayForm -> HTML;
                ?>
            </div>
<?php
    require_once("includes/footerAdmin.php");
?>
           
           
           
       
   