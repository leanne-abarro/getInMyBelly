<?php
    require_once("connection.php");
    require_once("product.php");

    class ProductManager {
        
        static public function getAllProducts (){
            
            $aAllProducts = array();
            
            $connection = new Connection();
            $sSQL = "SELECT ProductID
                     FROM tbproduct
                     ORDER BY CreatedAt DESC
                     ";
                      
            $resultSet = $connection -> query($sSQL);
            
            while ($row = $connection -> fetch_array($resultSet)){
                
                $iProductID = $row['ProductID'];
                $oProduct = new Product();
                $oProduct -> load($iProductID);
                $aAllProducts[] = $oProduct;
            }
            
            $connection -> close_connection();
            return $aAllProducts;
        }
    }

    //testing

  //  $oRM = new RecipeManager();
  //  $aAllRecipes = $oRM -> getAllRecipes();

  //   echo "<pre>";
	 // print_r($aAllRecipes);
	 // echo "</pre>";
?>