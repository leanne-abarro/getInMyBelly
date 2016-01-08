<?php
    require_once("includes/header.php");
    require_once("includes/recipe.php");
    require_once("includes/recipeManager.php");
    require_once("includes/form.php");
    require_once("includes/comments.php");


	$iRecipeID = 5; // make this comment id
    
      if(isset($_GET["RecipeID"])){
        $iRecipeID = $_GET["RecipeID"];
    }

    $oRecipe = new Recipe();
    $oRecipe ->load($iRecipeID);


	 // construct comment box

    $oReplyForm = new Form();
      
    if (isset($_POST["reply"])) {
        
        if (isset($_SESSION["UserID"]) == false){ 

        header("Location:recipePage.php?message=signIn&RecipeID=".$iRecipeID);
        exit; // terminates request
        
        }

        $oReplyForm -> data = $_POST;
        
        $oComment = new Comment();
        $oComment -> comment = $_POST["commentBox"];
        $oComment -> userID = $oCustomer -> userID;
        $oComment -> originalID = $oComment -> commentID;
        
        $oComment -> save();
          
          header("Location:recipePage.php?message=commentAdded&RecipeID=".$iRecipeID);
          exit; // terminates request
    }
    
    $oReplyForm -> makeCommentBoxTextArea("commentBox");
    $oReplyForm -> makeSubmit("reply","Add Comment","displayBlock blueButton2 bgBlue marginBottom10 paddingTop10 paddingBottom10 floatRight");
    echo $oReplyForm ->HTML;



    require_once("includes/footer.php");
 ?>