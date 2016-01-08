<?php
    require_once("connection.php");
    require_once("recipe.php");

    class RecipeManager {
        
        static public function getAllRecipes (){
            
            $aAllRecipes = array();
            
            $connection = new Connection();
            $sSQL = "SELECT RecipeID
                     FROM tbrecipe
                     ORDER BY CreatedAt DESC
                     ";
                      
            $resultSet = $connection -> query($sSQL);
            
            while ($row = $connection -> fetch_array($resultSet)){
                
                $iRecipeID = $row['RecipeID'];
                $oRecipe = new Recipe();
                $oRecipe -> load($iRecipeID);
                $aAllRecipes[] = $oRecipe;
            }
            
            $connection -> close_connection();
            return $aAllRecipes;
        }
    }

    //testing

  //  $oRM = new RecipeManager();
  //  $aAllRecipes = $oRM -> getAllRecipes();

  //   echo "<pre>";
	 // print_r($aAllRecipes);
	 // echo "</pre>";
?>