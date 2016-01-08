<?php
    require_once("connection.php");
    require_once("likes.php");
    require_once("comments.php");

    class Recipe {
        
        private $iRecipeID;
        private $sTitle;
        private $sAuthorNotes;
        private $sIngredients;
        private $sDirections;
        private $sImagePath;
        private $tCreatedAt;
        private $iUserID;
        private $iRecipeTypeID;
        private $aLikes;
        private $aComments;
        
        public function __construct (){
            
            $this -> iRecipeID = 0;
            $this -> sTitle = "";
            $this -> sAuthorNotes = "";
            $this -> sIngredients = "";
            $this -> sDirections = "";
            $this -> sImagePath = "";
            $this -> tCreatedAt = "";
            $this -> iUserID = 0;
            $this -> iRecipeTypeID = 0;
            $this -> aLikes = array();
            $this -> aComments = array();
        }
        
        public function load ($iRecipeID) {
            $connection = new Connection();
            $sSQL = "SELECT RecipeID, Title, AuthorNotes, Ingredients, Directions, ImagePath, CreatedAt, UserID, RecipeTypeID
                     FROM tbrecipe
                     WHERE RecipeID = ".$iRecipeID;
            
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);
            
            //store into attributes:
            
            $this -> iRecipeID = $row["RecipeID"];
            $this -> sTitle = $row["Title"];
            $this -> sAuthorNotes = $row["AuthorNotes"];
            $this -> sIngredients = $row["Ingredients"];
            $this -> sDirections = $row["Directions"];
            $this -> sImagePath = $row["ImagePath"];
            $this -> tCreatedAt = $row["CreatedAt"];
            $this -> iUserID = $row["UserID"];
            $this -> iRecipeTypeID = $row["RecipeTypeID"];

            // get all likes from recipe:

            $sSQL = "SELECT LikeID
                     FROM tblike
                     WHERE RecipeID = ".$iRecipeID;

            $resultSet = $connection -> query($sSQL);

            while ($row = $connection -> fetch_array($resultSet)){

                $iLikeID = $row["LikeID"];
                $oLike = new Like();
                $oLike -> load($iLikeID);
                $this -> aLikes[] = $iLikeID;
            }
            
            // get all comments on a recipe:

           $sSQL = "SELECT CommentID
                    FROM tbcomment
                    WHERE RecipeID = ".$iRecipeID." ORDER BY CreatedAt DESC";

           $resultSet = $connection -> query($sSQL);

           while ($row = $connection -> fetch_array($resultSet)){

               $iCommentID = $row["CommentID"];
               $oComment = new Comment();
               $oComment -> load($iCommentID);
               $this -> aComments[] = $oComment;
           }
            
            $connection -> close_connection();
        }
        
        public function save (){
            
            $connection = new Connection();

            if($this -> iRecipeID == 0){
                $sSQL = "INSERT INTO tbrecipe(Title, AuthorNotes, Ingredients, Directions, ImagePath, UserID, RecipeTypeID)
                     VALUES ('".$connection -> escape($this -> sTitle)."','".$connection -> escape($this -> sAuthorNotes)."','".$connection -> escape($this -> sIngredients)."','".$connection -> escape($this -> sDirections)."','".$connection -> escape($this -> sImagePath)."','".$connection -> escape($this -> iUserID)."','".$connection -> escape($this -> iRecipeTypeID)."')";
            
                $bSuccess = $connection -> query($sSQL);
                
                if ($bSuccess == true){
                    
                    $this -> iRecipeID = $connection -> get_insert_id();
                } else {
                    die($sSQL." fails!");
                }
            }else{ // update instead
                
                $sSQL = "UPDATE tbrecipe
                         SET Title = '".$connection -> escape($this -> sTitle)."',AuthorNotes ='".$connection -> escape($this -> sAuthorNotes)."',Ingredients='".$connection -> escape($this -> sIngredients)."',Directions='".$connection -> escape($this -> sDirections)."',ImagePath='".$connection -> escape($this -> sImagePath)."',UserID='".$connection -> escape($this -> iUserID)."', RecipeTypeID='".$connection -> escape($this -> iRecipeTypeID)."'
                         WHERE RecipeID=".$this -> iRecipeID;
                
                $bSuccess = $connection -> query($sSQL);

				if ($bSuccess == false){

					die($sSQL. " fails!");
				}
            }
            
        }
        
        
        public function __get ($sKey){
            
            switch ($sKey){
                
                case 'recipeID':
                return $this -> iRecipeID;
                    break;
                
                case 'title':
                return $this -> sTitle;
                    break;
                
                case 'authorNotes':
                return $this -> sAuthorNotes;
                    break;
                
                case 'ingredients':
                return $this -> sIngredients;
                    break;
                
                case 'directions':
                return $this -> sDirections;
                    break;
                
                case 'imagePath':
                return $this -> sImagePath;
                    break;
                
                case 'createdAt':
                return $this -> tCreatedAt;
                    break;
                
                case 'userID':
                return $this -> iUserID;
                    break;
                
                case 'recipeTypeID':
                return $this -> iRecipeTypeID;
                    break;

                case 'likes':
                return $this -> aLikes;
                    break;

                case 'comments':
                return $this -> aComments;
                    break;
                
                default:
                die ($sKey." does not exist.");
                
            }
        }
        
        public function __set ($sKey, $value){
            switch ($sKey){
                
                case 'title':
                $this -> sTitle = $value;
                    break;
                
                case 'authorNotes':
                $this -> sAuthorNotes = $value;
                    break;
                
                case 'ingredients':
                $this -> sIngredients = $value;
                    break;
                
                case 'directions':
                $this -> sDirections = $value;
                    break;
                
                case 'imagePath':
                $this -> sImagePath = $value;
                    break;
                
                case 'createdAt':
                $this -> tCreatedAt = $value;
                    break;
                
                case 'userID':
                $this -> iUserID = $value;
                    break;
                
                case 'recipeTypeID':
                $this -> iRecipeTypeID = $value;
                    break;

                case 'likes':
                $this -> aLikes = $value;
                    break;
                
                default:
                die ($sKey." does not exist.");
            }
        }   
    }

// testing

// $oRecipe = new Recipe();
// $oRecipe -> load(28);


// print_r($oRecipe);

?>