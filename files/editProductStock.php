<?php
    require_once("includes/header.php");
    require_once("includes/product.php");
    require_once("includes/productManager.php");
    require_once("includes/form.php");

    if(isset($_POST["save"])){

        $oProduct = new Product();
        $oProduct->load($_POST["productID"]);

        $oProduct -> stockLevel = $_POST["stockLevel"];

        $oProduct -> save();
        
        // redirect after adding new page successfully to that new location

			header("Location:editProductStock.php?message=stockUpdated");
			exit; // terminates request  

    }

    $aForms = array();
    $aAllProducts = ProductManager::getAllProducts();
    for($iCount=0; $iCount < count($aAllProducts); $iCount++){
      
      $oProduct = $aAllProducts[$iCount];

      $oStockLevelForm = new Form();

      $aStickyData = array();
      $aStickyData["stockLevel"] = $oProduct->stockLevel;
      $oStockLevelForm -> data = $aStickyData;


      // form markup:
      $oStockLevelForm -> stockInput("stockLevel","","floatLeft");
      $oStockLevelForm -> makeHiddenField("productID",$oProduct->productID);
      $oStockLevelForm -> makeSubmit("save","Save","blueButton bgBlue selfClear");

      $aForms[] = $oStockLevelForm;
    }

    

    // stock level form

    echo View::renderProductStockMgtEdit($aAllProducts,$aForms);

    if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "stockUpdated"){
                    echo '<div class="stockUpdate formSuccess textAlignCenter">Stock level has now been updated.</div>';
                  }

    }

    require_once("includes/footerAdmin.php");
?>
