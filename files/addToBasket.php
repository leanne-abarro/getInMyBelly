<?php
    require_once("includes/basket.php");
    require_once("includes/product.php");

	session_start();

	if (isset($_SESSION["UserID"]) == false){ // if user hasn't logged on

		// redirect back to login if user has not logged on.
			header("Location:loginSignUp.php");
			exit; // terminates request
	}

    $oBasket = $_SESSION["basket"];       

    $iProductID = $_POST["ProductID"];

	$iQuantity = $_POST["quantity"];
    
    if ($iQuantity == 0){
        
        header("Location: shopItem.php?message=noQuantity&ProductID=".$iProductID);
        exit;
    } else {
        $oBasket -> add($iProductID, $iQuantity);

	       header("Location: shopItem.php?message=itemAdded&ProductID=".$iProductID);
           exit;
    }

	

//	print_r($oBasket);

?>