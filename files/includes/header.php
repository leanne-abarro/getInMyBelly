<?php

ob_start();
require_once("basket.php");
	session_start();
    
    require_once("user.php");
    require_once("recipeTypeManager.php");
    require_once("view.php");


    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

$aAllTypes = RecipeTypeManager::getAllTypes();

    // print_r($_SESSION["basket"]);
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Get In My Belly</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- JS
  ================================================== -->

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="assets/stylesheets/base.css">
	<link rel="stylesheet" href="assets/stylesheets/skeleton.css">
	<link rel="stylesheet" href="assets/stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Fonts
	================================================== -->
	<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700,300italic,400italic,600italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">

</head>
<body>
   <div class="container selfClear">
       <!-- top header -->
        <a href="index.php"><img class="six columns offset-by-five marginTop20 floatLeft paddingBottom20" src="images/getInMyBellyLogo.jpg" alt="get-in-my-belly-logo"  /></a>
        <div class="topNav four columns offset-by-one floatLeft paddingTop30">
            <span class="paddingTop10">
            <?php 
                $fTotal = 0;

                if(isset($_SESSION["basket"]) == true){

                  $oBasket = $_SESSION["basket"];

                    foreach($oBasket-> contents as $iProductID => $iQuantity){

                      $oProduct = new Product();
                      $oProduct->load($iProductID);

                      $fTotal += $oProduct -> price * $iQuantity;
                    }
                }
            ?>
            <?php 
            	if (isset($_SESSION["UserID"]) == true){
            		$oCustomer = new User();
            		$oCustomer -> load($_SESSION["UserID"]);
            		echo '<span class="colour3A"> Hello '.$oCustomer -> firstName.'!</span> | <a href="logout.php"><i class="fa fa-sign-out marginRight5"></i>Logout</a></span>
            		<span class="topNav paddingTop10"><a href="myAccount.php"><i class="fa fa-user marginRight5"></i>My Account</a> | <a href="shoppingBasket.php"><i class="fa fa-shopping-cart marginRight5"></i>Basket ($'.$fTotal.')</a></span>';
                    
                    if ($oCustomer -> admin != 0){
                        echo '<span class="topNav paddingTop10"><a href="adminAccount.php"><i class="fa fa-key marginRight5"></i>Admin Account</a>';
                    }
            	} else { 
            		echo '<a href="loginSignUp.php"><i class="fa fa-sign-in marginRight5"></i>Log-In</a> | <a href="loginSignUp.php"><i class="fa fa-plus marginRight5"></i>Create Account</a></span>
            		<span class="topNav paddingTop10"><a href="shoppingBasket.php"><i class="fa fa-shopping-cart marginRight5"></i>Basket ($'.$fTotal.')</a></span>';
            	}
            ?>
        </div>
   </div>
   <!-- navigation -->
   <div class="container marginBottom20 selfClear">
        <div class="siteNavigation mainNav" id="mainNav">
            <label for="show-menu" class="show-menu">Menu</label>
            <input type="checkbox" id="show-menu" role="button">
            <ul class="offset-by-five" id="menu">
                <li class="floatLeft two columns textAlignCenter"><a href="index.php">Home</a></li>
                <li class="floatLeft two columns textAlignCenter">
                    <a href="recipesLanding.php">Recipes</a>
                    <?php
                        echo View::renderRecipeNavDropdown($aAllTypes);
                      ?>
                </li>
                <li class="floatLeft two columns textAlignCenter"><a href="shop.php">Shop</a></li>
            </ul>
        </div>
   </div>
   <!-- header 1 section -->
   <div class="container">