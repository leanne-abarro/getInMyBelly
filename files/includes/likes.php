<?php
	require_once("connection.php");
	require_once("user.php");

	class Like {

		private $iLikeID;
		private $iUserID;
		private $iRecipeID;

		public function __construct (){

			$this -> iLikeID = 0;
			$this -> iUserID = 0;
			$this -> iRecipeID = 0;
		}

		public function load ($iLikeID){

			$connection = new Connection();

			$sSQL = "SELECT LikeID, UserID, RecipeID
			         FROM tblike
			         WHERE LikeID = ".$iLikeID;

			$resultSet = $connection -> query($sSQL);
			$row = $connection -> fetch_array($resultSet);

			// store into attributes:

			$this -> iLikeID = $row["LikeID"];
			$this -> iUserID = $row["UserID"];
			$this -> iRecipeID = $row["RecipeID"];

			$connection -> close_connection();
		}

		public function loadByUserRecipe ($iUserID,$iRecipeID){ // checks if user has already liked recipe

			$connection = new Connection();
			$sSQL = "SELECT LikeID
				     FROM tblike
				     WHERE UserID='".$connection -> escape($iUserID)."' AND RecipeID='".$connection -> escape($iRecipeID)."'";
			$resultSet = $connection -> query($sSQL);
			$row = $connection -> fetch_array($resultSet);

			if ($row == false){ // user hasn't liked recipe
				return false;
			} else {

				$this ->load($row["LikeID"]);

				return true;
			}
		}

		public function save (){

			$connection = new Connection();

			$sSQL = "INSERT INTO tblike(UserID, RecipeID)
			         VALUES ('".$connection -> escape($this -> iUserID)."','".$connection -> escape($this -> iRecipeID)."')";
			
			$bSuccess = $connection -> query($sSQL);

			if ($bSuccess == true){

				$this -> iLikeID = $connection -> get_insert_id();
			} else {
                die($sSQL." fails!");
            }
		}

		public function __get ($sKey){

			switch ($sKey){
				case 'likeID':
				return $this -> iLikeID;
					break;

				case 'userID':
				return $this -> iUserID;
					break;

				case 'recipeID':
				return $this -> iRecipeID;
					break;

				default:
                die ($sKey." does not exist.");
			}

		}

		public function __set ($sKey, $value){
            switch ($sKey){

            	case 'userID':
                $this -> iUserID  = $value;
                    break;

                case 'recipeID':
                $this -> iRecipeID = $value;
                	break;

                default:
                die ($sKey." does not exist.");
            }
        }

	}

	//testing


?>