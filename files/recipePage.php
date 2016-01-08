<?php
    require_once("includes/header.php");
    require_once("includes/recipe.php");
    require_once("includes/recipeManager.php");
    require_once("includes/form.php");
    require_once("includes/comments.php");

    $aAllTypes = RecipeTypeManager::getAllTypes();

    if (isset($_SESSION["UserID"]) == true){ 

        $oCustomer = new User();
        $oCustomer -> load($_SESSION["UserID"]);
        $oCustomer -> userID;
    }

    $iRecipeID = 5;
    
      if(isset($_GET["RecipeID"])){
	  	$iRecipeID = $_GET["RecipeID"];
	  }
    
	 $oRecipe = new Recipe();
	 $oRecipe ->load($iRecipeID);

    // construct comment box

    $oCommentForm = new Form();
      
    if (isset($_POST["comment"])) {
        
        if (isset($_SESSION["UserID"]) == false){ 

        header("Location:recipePage.php?message=signIn&RecipeID=".$iRecipeID);
        exit; // terminates request
        
        }
        
        $oCommentForm -> data = $_POST;
        
        $oComment = new Comment();
        $oComment -> comment = $_POST["commentBox"];
        $oComment -> userID = $oCustomer -> userID;
        $oComment -> recipeID = $oRecipe -> recipeID;
        $oComment -> save();
          
          header("Location:recipePage.php?message=commentAdded&RecipeID=".$iRecipeID);
          exit; // terminates request
    }
    
    $oCommentForm -> makeCommentBoxTextArea("commentBox");
    $oCommentForm -> makeSubmit("comment","Add Comment","displayBlock blueButton2 bgBlue marginBottom10 paddingTop10 paddingBottom10 floatRight");


    //construct reply comment form box

    // $iCommentID = 5;
    
    //  if(isset($_GET["commentID"])){
    //   $iCommentID = $_GET["commentID"];
    //  }
    
   $oComment = new Comment();


    $oReplyForm = new Form();

        if (isset($_POST["reply"])) {

            if (isset($_SESSION["UserID"]) == false){ 

            header("Location:recipePage.php?message=signIn&RecipeID=".$iRecipeID);
            exit; // terminates request

            }

            $oReplyForm -> data = $_POST;

            $oComment = new Comment();
            $oComment -> comment = $_POST["replyCommentBox"];
            $oComment -> userID = $oCustomer -> userID;
            $oComment -> originalID = $_POST["commentID"];
            $oComment -> saveReply();

              header("Location:recipePage.php?message=commentAdded&RecipeID=".$iRecipeID);
              exit; // terminates request
        }

        $oReplyForm -> makeHiddenField("commentID",0);
        $oReplyForm -> makeCommentBoxTextArea("replyCommentBox");
        $oReplyForm -> makeSubmit("reply","Reply","displayBlock blueButton2 bgBlue marginBottom10 paddingTop10 paddingBottom10 floatRight");


    // recipe nav
      
        echo View::renderRecipeNav($aAllTypes);
    
    //recipe page

        echo View::renderRecipePage($oRecipe);
?>
        <div class="clearBoth sixteen columns">
           <!-- add comment -->
           <h3>Comments</h3>
           <div class="commentBox bgCC selfClear marginBottom20">
               <?php
                    echo $oCommentForm ->HTML;
                    if(isset($_GET["message"]) == true){

                      if($_GET["message"] == "commentAdded"){
                        echo '<div class="commentAdded formSuccess">Your comment has now been added!</div>';
                      }
                        
                      if($_GET["message"] == "signIn"){
                        echo '<div class="signIn formError">* Please log-in before posting a comment.</div>';
                      }

                    } 
               ?>
           </div>
           <!-- show comments posted -->
           <div class="commentsPosted">
              <?php
                  echo View::renderRecipeComments($oRecipe);
               ?>
           </div>
       </div>
       <!-- popup for reply to comment form -->
    <div id="overlayCommentReply" class="hide">
        <div class="modalContainer">

                <a href="" id="closePopup" class="closeButton">Close</a>

            <h3>Post a Reply</h3>
               <?php
                    echo $oReplyForm ->HTML;
                    if(isset($_GET["message"]) == true){

                      if($_GET["message"] == "commentAdded"){
                        echo '<div class="commentAdded formSuccess">Your comment has now been added!</div>';
                      }
                        
                      if($_GET["message"] == "signIn"){
                        echo '<div class="signIn formError">* Please log-in before posting a comment.</div>';
                      }

                    } 
               ?>

        </div>
    </div>
    <!-- script for pop up modal -->
    <script type="text/javascript" src="assets/js/commentReplyPopup.js"></script>
    
<?php
    require_once("includes/footer.php");
?>