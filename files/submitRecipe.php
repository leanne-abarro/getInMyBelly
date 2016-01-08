<?php
    require_once("includes/header.php");
    require_once("includes/recipe.php");
    require_once("includes/recipeType.php");
    require_once("includes/form.php");
    
    if (isset($_SESSION["UserID"])== false){
		header("Location: loginSignUp.php");
		exit;
	}

    $oCustomer = new User();
    $oCustomer -> load($_SESSION["UserID"]);
    $oCustomer -> userID;

    $oSubmitForm = new Form();

    if (isset($_POST["submit"])) {
        $oSubmitForm -> data = $_POST;
        $oSubmitForm -> files = $_FILES;
        
        //form validation
        $oSubmitForm -> checkFilled("recipeTitle");
        $oSubmitForm -> checkFilled("authorNotes");
        $oSubmitForm -> checkFilled("ingredients");
        $oSubmitForm -> checkFilled("directions");
        $oSubmitForm -> checkFileUpload("imageUpload");
        
        
        if ($oSubmitForm -> valid == true){
            
            $oRecipe = new Recipe();
            
            //save details:
            $sImageName = "recipeImage-".date("Y-m-d-H-i-s").".jpg";
			
            $oSubmitForm -> moveFile("imageUpload",$sImageName);
            
            $oRecipe -> title = $_POST["recipeTitle"];
            $oRecipe -> authorNotes = $_POST["authorNotes"];
            $oRecipe -> ingredients = $_POST["ingredients"];
            $oRecipe -> directions = $_POST["directions"];
            $oRecipe -> imagePath = $sImageName;
            $oRecipe -> userID = $oCustomer -> userID;
            $oRecipe -> recipeTypeID = $_POST["recipeCategory"];
            
            $oRecipe -> save();
            
     
            header("Location: submitRecipe.php?message=submitted");
			exit;
        }
    }

    //html markup:
    $oSubmitForm -> makeInput("recipeTitle","Recipe Title *","eight columns floatLeft marginBottom10");
    $oSubmitForm -> makeSelect("recipeCategory","Recipe Category *",RecipeTypeManager::listAllTypes(),"eight columns floatLeft marginBottom10");
    $oSubmitForm -> makeImageUpload("imageUpload","Image Upload *");
    $oSubmitForm -> makeTextArea("authorNotes","Author Notes *","eight columns floatLeft marginBottom10");
    $oSubmitForm -> makeTextArea("ingredients","Ingredients *","eight columns floatLeft marginBottom10");
    $oSubmitForm -> makeTextArea("directions","Directions *","clearBoth marginRight10 marginBottom30 marginLeft10");
    $oSubmitForm -> makeSubmit("submit","submit","blueButton2 bgBlue marginBottom10");
?>
       <h1 class="textAlignCenter marginBottom30">Submit a Recipe</h1>
       <span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">* Required Fields </span>
       <!-- submit recipe form starts here -->
       <div class="otherForms">
           <?php
                echo $oSubmitForm -> HTML;

                if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "submitted"){
                    echo '<div class="recipeSubmitted formSuccess">Recipe Submitted!</div>';
                  }

                } 
           ?>
       </div>
       
<?php
    require_once("includes/footerAdmin.php");
?>
