<?php
    require_once("includes/header.php");
    require_once("includes/form.php");


    if (isset($_SESSION["UserID"]) == false){ // if user hasn't logged on

		// redirect back to login if user has not logged on.
			header("Location:loginSignUp.php");
			exit; // terminates request
	}    

   $oBasket = $_SESSION["basket"];       

    $iProductID = 1;
    
      if(isset($_GET["ProductID"])){
	  	$iProductID = $_GET["ProductID"];
	  }
    
	 $oProduct = new Product();
	 $oProduct ->load($iProductID);


	echo View::renderShoppingBasket($oBasket);

      require_once("includes/footerAdmin.php");
?>
