<?php
    require_once("includes/basket.php");

	session_start();

    $oBasket = $_SESSION["basket"];       

    $iProductID = $_GET["ProductID"];

	$oBasket -> remove($iProductID);

	header("Location: shoppingBasket.php");
            exit;

//	print_r($oBasket);

?>