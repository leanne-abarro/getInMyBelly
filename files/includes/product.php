<?php
    require_once("connection.php");

    class Product {
        private $iProductID;
        private $sProductName;
        private $sDescription;
        private $fPrice;
        private $sSize;
        private $sIngredients;
        private $iStockLevel;
        private $sImagePath;
        private $tCreatedAt;


        public function __construct (){

            $this -> iProductID = 0;
            $this -> sProductName = "";
            $this -> sDescription = "";
            $this -> fPrice = 0;
            $this -> sSize = "";
            $this -> sIngredients = "";
            $this -> iStockLevel = 0;
            $this -> sImagePath = "";
            $this -> tCreatedAt = "";

        }

        public function load ($iProductID){

            $connection = new Connection();
            $sSQL = "SELECT ProductID, ProductName, Description, Price, Size, Ingredients, StockLevel, ImagePath, CreatedAt
                     FROM tbproduct
                     WHERE ProductID=".$iProductID;
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);

            //store into attributes:

            $this -> iProductID = $row["ProductID"];
            $this -> sProductName = $row["ProductName"];
            $this -> sDescription = $row["Description"];
            $this -> fPrice = $row["Price"];
            $this -> sSize = $row["Size"];
            $this -> sIngredients = $row["Ingredients"];
            $this -> iStockLevel = $row["StockLevel"];
            $this -> sImagePath = $row["ImagePath"];
            $this -> tCreatedAt = $row["CreatedAt"];

            $connection -> close_connection();
        }
        

        public function save (){

            $connection = new Connection();

            if ($this -> iProductID == 0){
                $sSQL = "INSERT INTO tbproduct(ProductName, Description, Price, Size, Ingredients, StockLevel, ImagePath)
                     VALUES ('".$connection -> escape($this -> sProductName)."','".$connection -> escape($this -> sDescription)."','".$connection -> escape($this -> fPrice)."','".$connection -> escape($this -> sSize)."','".$connection -> escape($this -> sIngredients)."','".$connection -> escape($this -> iStockLevel)."','".$connection -> escape($this -> sImagePath)."')";

                $bSuccess = $connection -> query($sSQL);

                if ($bSuccess == true){

                        $this -> iProductID = $connection -> get_insert_id();
                    } else {
                        die($sSQL." fails!");
                    }
            } else { //update instead

                $sSQL = "UPDATE tbproduct
                         SET ProductName = '".$connection -> escape($this -> sProductName)."',Description ='".$connection -> escape($this -> sDescription)."',Price='".$connection -> escape($this -> fPrice)."',Size='".$connection -> escape($this -> sSize)."',Ingredients='".$connection -> escape($this -> sIngredients)."',StockLevel='".$connection -> escape($this -> iStockLevel)."', ImagePath='".$connection -> escape($this -> sImagePath)."'
                         WHERE ProductID=".$this -> iProductID;
                
                $bSuccess = $connection -> query($sSQL);

                if ($bSuccess == false){

                    die($sSQL. " fails!");
                }
            }
            
        }

        public function __get ($sKey){

                switch ($sKey){

                    case 'productID':
                    return $this -> iProductID;
                        break;

                    case 'productName':
                    return $this -> sProductName;
                        break;

                    case 'description':
                    return $this -> sDescription;
                        break;

                    case 'price':
                    return $this -> fPrice;
                        break;

                    case 'size':
                    return $this -> sSize;
                        break;

                    case 'ingredients':
                    return $this -> sIngredients;
                        break;

                    case 'stockLevel':
                    return $this -> iStockLevel;
                        break;

                    case 'imagePath':
                    return $this -> sImagePath;
                        break;

                    case 'createdAt':
                    return $this -> tCreatedAt;
                        break;
                    
                    case 'products':
                    return $this -> aProducts;
                        break;

                    default:
                    die ($sKey." does not exist.");

                }
            }

            public function __set ($sKey, $value){
                switch ($sKey){

                    case 'productName':
                    $this -> sProductName = $value;
                        break;

                    case 'description':
                    $this -> sDescription = $value;
                        break;

                    case 'price':
                    $this -> fPrice = $value;
                        break;

                    case 'size':
                    $this -> sSize = $value;
                        break;

                    case 'ingredients':
                    $this -> sIngredients = $value;
                        break;

                    case 'stockLevel':
                    $this -> iStockLevel = $value;
                        break;

                    case 'imagePath':
                    $this -> sImagePath = $value;
                        break;

                    case 'createdAt':
                    $this -> tCreatedAt = $value;
                        break;

                    default:
                    die ($sKey." does not exist.");
                }
            } 
    }

    //testing

//    $oProduct = new Product();
//    $oProduct -> load(4);
//
//    	 echo "<pre>";
//	 print_r($oProduct);
//	 echo "</pre>";
?>