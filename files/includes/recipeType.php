<?php
    require_once("connection.php");
    require_once("recipe.php");
    
    class RecipeType {
        
        private $iRecipeTypeID;
        private $sTypeName;
        private $sDescription;
        private $iDisplayOrder;
        private $aRecipes;

        public function __construct (){
            $this -> iRecipeTypeID = 0;
            $this -> sTypeName = "";
            $this -> sDescription = "";
            $this -> iDisplayOrder = 0;
            $this -> aRecipes = array();
        }

        public function load ($iRecipeTypeID){
            $connection = new Connection();
            $sSQL = "SELECT RecipeTypeID, TypeName, Description, DisplayOrder
                     FROM tbrecipetype
                     WHERE RecipeTypeID=".$iRecipeTypeID;
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);

            //store into data attribues:

            $this -> iRecipeTypeID = $row["RecipeTypeID"];
            $this -> sTypeName = $row["TypeName"];
            $this -> sDescription = $row["Description"];
            $this -> iDisplayOrder = $row["DisplayOrder"];

            // get all recipe IDs of type:

            $sSQL = "SELECT RecipeID
                     FROM tbrecipe
                     WHERE RecipeTypeID=".$iRecipeTypeID."
                     ORDER BY CreatedAt DESC";
                     
            $resultSet = $connection -> query($sSQL);

            while ($row = $connection -> fetch_array($resultSet)) {
                $iRecipeID = $row['RecipeID'];
                $oRecipe = new Recipe();
                $oRecipe -> load($iRecipeID);
                $this -> aRecipes[] = $oRecipe;
            }

            $connection -> close_connection();
        }
        
        public function __get ($sKey){
            
            switch ($sKey){
                case 'recipeTypeID':
                return $this -> iRecipeTypeID;
                    break;
                
                case 'typeName':
                return $this -> sTypeName;
                    break;
                
                case 'description':
                return $this -> sDescription;
                    break;
                
                case 'displayOrder':
                return $this -> iDisplayOrder;
                    break;
                
                case 'recipes':
                return $this -> aRecipes;
                    break;
                
                default:
                die ($sKey. " does not exist!");
            }
        }
    }

    // testing

//    $oType = new RecipeType();
//    $oType -> load (1);
//
//    echo "<pre>";
//	 print_r($oType);
//	 echo "</pre>";
    
?>