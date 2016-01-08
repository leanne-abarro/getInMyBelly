<?php
    require_once("includes/header.php");
    require_once("includes/product.php");
    require_once("includes/productManager.php");
    require_once("includes/form.php");
    
    
    $iProductID = 1;
    
      if(isset($_GET["ProductID"])){
	  	$iProductID = $_GET["ProductID"];
	  }
    
	 $oProduct = new Product();
	 $oProduct ->load($iProductID);

   $oBasketForm = new Form("addToBasket.php");

    // form markup:
    $oBasketForm -> makeHiddenField("ProductID",$iProductID);
    $oBasketForm -> quantityInput("quantity","Quantity","addQuantity");
    $oBasketForm -> makeSubmit("addToBasket","Add to Basket","displayBlock clearBoth blueButton2 bgBlue marginTop10 marginBottom10");

    // main product info:
    
    echo View::renderShopItem($oProduct,$oBasketForm);

    if(isset($_GET["message"]) == true){

      if($_GET["message"] == "itemAdded"){
        echo '<div class="addToBasket formSuccess">Item has been added to basket.</div>';
      }
    
      if($_GET["message"] == "noQuantity"){
        echo '<div class="addToBasket formError">* Must select quantity.</div>';
      }

    }  

    $aAllProducts = ProductManager::getAllProducts();

?>             
       
       <!-- latest shop items section -->
       <div class="clearBoth floatLeft">
            <h3 class="marginTop20 marginBottom30">You Might Also Like...</h3>
            <div class="minimised4 selfClear">
              <?php
                  echo View::renderProducts($aAllProducts);              
              ?>
          </div>
       </div>

<?php

    // testing
   // print_r($oBasket);
    require_once("includes/footer.php");
?>