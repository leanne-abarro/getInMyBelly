<?php
    require_once("includes/recipe.php");
        
    session_start();

    if (isset($_SESSION["UserID"]) == false){ // if user hasn't logged on

		// redirect back to login if user has not logged on.
			header("Location:loginSignUp.php");
			exit; // terminates request
	}

	$iRecipeID = 1;
    
    if (isset($_GET["RecipeID"])){
		$iRecipeID = $_GET["RecipeID"];
	}

    $oCustomer = new User();
    $oCustomer -> load($_SESSION["UserID"]);
    $oCustomer -> userID;

    $oRecipe = new Recipe();

    $oRecipe -> load($iRecipeID);


    
    $oLike = new Like();

    $oLike -> userID = $oCustomer -> userID;

    $oLike -> recipeID = $iRecipeID;

    $oLike -> save();

    // redirect after adding new page successfully to that new location
            
          if(isset($_SESSION['url'])) 
               $url = $_SESSION['url']; // holds url for last page visited.
            else 
               $url = "index.php"; // default page for 

            header("Location: $url"); // perform correct redirect.

          exit; // terminates request
?>