<?php
    require_once("connection.php");

    class Comment {
        
        private $iCommentID;
        private $sComment;
        private $iUserID;
        private $iRecipeID;
        private $tCreatedAt;
        private $iOriginalID;
        private $aReplies;
        
        public function __construct (){
            
            $this -> iCommentID = 0;
            $this -> sComment = "";
            $this -> iUserID = 0;
            $this -> iRecipeID = null;
            $this -> tCreatedAt = 0;
            $this -> iOriginalID = null;
            $this -> aReplies = array();
            
        }
        
        public function load ($iCommentID){
            
            $connection = new Connection();
            
            $sSQL = "SELECT CommentID, Comment, UserID, RecipeID, CreatedAt, OriginalID
                     FROM tbcomment
                     WHERE CommentID=".$iCommentID;
            
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);
            
            //store data into attributes:
            
            $this -> iCommentID = $row["CommentID"];
            $this -> sComment = $row["Comment"];
            $this -> iUserID = $row["UserID"];
            $this -> iRecipeID = $row["RecipeID"];
            $this -> tCreatedAt = $row["CreatedAt"];
            $this -> iOriginalID = $row["OriginalID"];
            
           $sSQL = "SELECT CommentID 
                    FROM tbcomment
                    WHERE OriginalID=".$iCommentID;

           $resultSet = $connection -> query($sSQL);

              while ($row = $connection -> fetch_array($resultSet)){

                  $iCommentID = $row["CommentID"];
                  $oComment = new Comment();
                  $oComment -> load($iCommentID);
                  $this -> aReplies[] = $oComment;
              }

            $connection -> close_connection();
        }
        
        public function save (){
            
            $connection = new Connection();
            
            $sSQL = "INSERT INTO tbcomment(Comment, UserID, RecipeID)
                     VALUES  ('".$connection -> escape($this -> sComment)."','".$connection -> escape($this -> iUserID)."','".$connection -> escape($this -> iRecipeID)."')";
            
            $bSuccess = $connection -> query($sSQL);
            
            if ($bSuccess == true){
                
                $this -> iCommentID = $connection -> get_insert_id();
            } else {
                die($sSQL." fails!");
            }
        }
        
        public function saveReply (){
            
            $connection = new Connection();
            
            $sSQL = "INSERT INTO tbcomment(Comment, UserID, OriginalID)
                     VALUES  ('".$connection -> escape($this -> sComment)."','".$connection -> escape($this -> iUserID)."','".$connection -> escape($this -> iOriginalID)."')";
            
            $bSuccess = $connection -> query($sSQL);
            
            if ($bSuccess == true){
                
                $this -> iCommentID = $connection -> get_insert_id();
            } else {
                die($sSQL." fails!");
            }
        }
        
        public function __get ($sKey){
             switch ($sKey){
                
                case 'commentID':
                return $this -> iCommentID;
                    break;

                case 'comment':
                return $this -> sComment;
                    break;

                case 'userID':
                return $this -> iUserID;
                    break;

                case 'recipeID':
                return $this -> iRecipeID;
                    break;

                case 'createdAt':
                return $this -> tCreatedAt;
                    break;

                case 'originalID':
                return $this -> iOriginalID;
                    break;

               case 'replies':
               return $this -> aReplies;
                   break;
                 
                default:
                die ($sKey." does not exist.");
             }
        }
        
        public function __set ($sKey, $value){
            switch ($sKey){
                
                case 'comment':
                $this -> sComment = $value;
                    break;
                
                case 'userID':
                $this -> iUserID = $value;
                    break;
                
                case 'recipeID':
                $this -> iRecipeID = $value;
                    break;

                case 'originalID':
                $this -> iOriginalID = $value;
                    break;
                
                default:
                die ($sKey." does not exist.");
            }
        }    
    
    }

    // TESTING

//    $oComment = new Comment();
//    $oComment->load(71);
// //    $oComment -> comment = "This is a comment";
// //    $oComment -> userID = 8;
// //    $oComment -> originalID =3;
// //    $oComment -> saveReply();
// //    
// //    
//     print_r($oComment);
?>