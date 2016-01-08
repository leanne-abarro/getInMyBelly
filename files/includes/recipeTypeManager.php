<?php
    require_once("connection.php");
    require_once("recipeType.php");

    class RecipeTypeManager {
        
        static public function getAllTypes (){ // creates index array
            
            $aRecipeTypes = array();
            
            $connection = new Connection();
            $sSQL = "SELECT RecipeTypeID
                     FROM tbrecipetype
                     ";
                      
            $resultSet = $connection -> query($sSQL);
            
            while ($row = $connection -> fetch_array($resultSet)){
                
                $iRecipeTypeID = $row['RecipeTypeID'];
                $oRecipeType = new RecipeType();
                $oRecipeType -> load($iRecipeTypeID);
                $aRecipeTypes[] = $oRecipeType;
            }
            
            $connection -> close_connection();
            return $aRecipeTypes;
        }

        static public function listAllTypes (){ // creates associative array
            
            $aRecipeTypes = array();
            
            $connection = new Connection();
            $sSQL = "SELECT RecipeTypeID,TypeName
                     FROM tbrecipetype
                     ";
                      
            $resultSet = $connection -> query($sSQL);
            
            while ($row = $connection -> fetch_array($resultSet)){
                
                $iRecipeTypeID = $row['RecipeTypeID'];
              
                $aRecipeTypes[$iRecipeTypeID] = $row['TypeName'];
            }
            
            $connection -> close_connection();
            return $aRecipeTypes;
        }
    }

    //testing

//    $oRTM = new RecipeTypeManager();
//    $aAllTypes = $oRTM -> getAllTypes();
//
//     echo "<pre>";
//	 print_r($aAllTypes);
//	 echo "</pre>";
?>