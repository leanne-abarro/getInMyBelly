<?php
    require_once("includes/header.php");
    require_once("includes/recipe.php");
    require_once("includes/recipeType.php");
    require_once("includes/form.php");

    if (isset($_SESSION["UserID"])== false){
		header("Location: loginSignUp.php");
		exit;
	}

    $iRecipeID = 1;

    if (isset($_GET["RecipeID"])){
		$iRecipeID = $_GET["RecipeID"];
	}

    $oRecipe = new Recipe();

    $oRecipe -> load($iRecipeID);

    $aExistingData = array();
  	$aExistingData["recipeTitle"] = $oRecipe -> title;
  	$aExistingData["authorNotes"] = $oRecipe -> authorNotes;
  	$aExistingData["ingredients"] = $oRecipe -> ingredients;
  	$aExistingData["directions"] = $oRecipe -> directions;
    $aExistingData["recipeCategory"] = $oRecipe -> recipeTypeID;


    // edit recipe

    $oEditForm = new Form();
    $oEditForm -> data = $aExistingData;

    if (isset($_POST["update"])){

      $oEditForm -> data = $_POST;
      $oEditForm -> files = $_FILES;

      //form validation
      $oEditForm -> checkFilled("recipeTitle");
      $oEditForm -> checkFilled("authorNotes");
      $oEditForm -> checkFilled("ingredients");
      $oEditForm -> checkFilled("directions");
//      $oEditForm -> checkFileUpload("imageUpload");
//      $oEditForm -> moveFile("imageUpload",$sImageName);

      if ($oEditForm -> valid == true){
            
            //updating details:
      
            
            $oRecipe -> title = $_POST["recipeTitle"];
            $oRecipe -> authorNotes = $_POST["authorNotes"];
            $oRecipe -> ingredients = $_POST["ingredients"];
            $oRecipe -> directions = $_POST["directions"];
//            $sImageName = "recipeImage".$oRecipe -> title.".jpg";
//            $oRecipe -> imagePath = $sImageName;
//            $oRecipe -> userID = $oCustomer -> userID;
//            $oRecipe -> recipeTypeID = $_POST["recipeCategory"];
            
            $oRecipe -> save();
            
            header("Location: editRecipe.php?message=updated&RecipeID=".$oRecipe -> recipeID);
            exit;
      }

    }
    //html markup:
    $oEditForm -> makeInput("recipeTitle","Recipe Title *","eight columns editRecipe floatLeft marginBottom10");
    $oEditForm -> makeSelect("recipeCategory","Recipe Category *",RecipeTypeManager::listAllTypes(),"eight columns floatLeft editRecipe marginBottom10");
    $oEditForm -> makeImageUpload("imageUpload","Image Upload *");
    $oEditForm -> makeTextArea("authorNotes","Author Notes *","eight columns editRecipe floatLeft marginBottom10");
    $oEditForm -> makeTextArea("ingredients","Ingredients *","eight columns editRecipe floatLeft marginBottom10");
    $oEditForm -> makeTextArea("directions","Directions *","clearBoth editRecipe marginRight10 marginBottom30 marginLeft10");
    $oEditForm -> makeSubmit("update","update","blueButton2 bgBlue marginBottom10");
?>
       <h1 class="textAlignCenter marginBottom30">Edit Recipe</h1>
       <span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">* Required Fields </span>
       <!-- submit recipe form starts here -->
       <div class="otherForms">
           <?php
                echo $oEditForm -> HTML;

                if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "updated"){
                    echo '<div class="recipeUpdate formSuccess">Recipe Update Successful!</div>';
                  }

                }  
           ?>
       </div>
       
<?php
    require_once("includes/footerAdmin.php");
?>
