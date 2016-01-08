<?php
	require_once("connection.php");
    require_once("recipe.php");

	class User {
		
		private $iUserID;
		private $sFirstName;
		private $sLastName;
        private $sUsername;
        private $sAddress;
        private $sEmail;
        private $iTelephone;
        private $sPassword;
        private $iAdmin;
        private $aRecipes;
        
        public function __construct (){
            
            $this -> iUserID = 0;
            $this -> sFirstName = "";
            $this -> sLastName = "";
            $this -> sUsername = "";
            $this -> sAddress = "";
            $this -> sEmail ="";
            $this -> iTelephone = 0;
            $this -> sPassword = "";
            $this -> iAdmin = 0;
            $this -> aRecipes = array();
        }
        
        public function load ($iUserID){
            $connection = new Connection();
            $sSQL = "SELECT UserID, FirstName, LastName, Username, Address, Email, Telephone, Password, Admin
                     FROM tbuser
                     WHERE UserID=".$iUserID;
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);
            
            //store data into attributes:
            
            $this -> iUserID = $row['UserID'];
            $this -> sFirstName = $row['FirstName'];
            $this -> sLastName = $row['LastName'];
            $this -> sUsername = $row['Username'];
            $this -> sAddress = $row['Address'];
            $this -> sEmail = $row['Email'];
            $this -> iTelephone = $row['Telephone'];
            $this -> sPassword = $row['Password'];
            $this -> iAdmin = $row['Admin'];
            
            // get all recipe ids of each user:
            
            $sSQL = "SELECT RecipeID
                     FROM tbrecipe
                     WHERE UserID=".$iUserID;
            
            $resultSet = $connection -> query($sSQL);
            
            while ($row = $connection -> fetch_array($resultSet)){
                $iRecipeID = $row["RecipeID"];
                $oRecipe = new Recipe();
                $oRecipe -> load($iRecipeID);
                $this -> aRecipes[] = $oRecipe;
            
            }
            
            $connection -> close_connection();
        }

        public function loadByUsername ($sUsername){// checks if username already exists in database

            $connection = new Connection();
            $sSQL = "SELECT UserID
                     FROM tbuser
                     WHERE Username='".$connection -> escape($sUsername)."'";
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);

            if ($row == false){ // if username doesn't exist

                return false;

            } else {
                $this -> load($row["UserID"]); // if username exists

                return true;
            }
        }

        public function save (){
            $connection = new Connection();
            
            if ($this -> iUserID == 0){ // if new customer
                $sSQL = "INSERT INTO tbuser (FirstName, LastName, Username, Address, Email, Telephone, Password, Admin)
                         VALUES ('".$connection -> escape($this -> sFirstName)."','".$connection -> escape($this -> sLastName)."','".$connection -> escape($this -> sUsername)."','".$connection -> escape($this -> sAddress)."','".$connection -> escape($this -> sEmail)."','".$connection -> escape($this -> iTelephone)."','".$connection -> escape($this -> sPassword)."','".$connection -> escape($this -> iAdmin)."')";
                
                $bSuccess = $connection -> query($sSQL);
                
                if ($bSuccess == true){
                    
                    $this -> iUserID = $connection -> get_insert_id();
                } else {
                    
                    die($sSQL." fails");
                }
            } else { // if updating an existing customer
                $sSQL = "UPDATE tbuser
                         SET UserID = '".$connection -> escape($this -> iUserID)."', FirstName ='".$connection -> escape($this -> sFirstName)."', LastName ='".$connection -> escape($this -> sLastName)."', Username = '".$connection -> escape($this -> sUsername)."', Address = '".$connection -> escape($this -> sAddress)."', Email = '".$connection -> escape($this -> sEmail)."', Telephone = '".$connection -> escape($this -> iTelephone)."', Password ='".($this -> sPassword)."', Admin ='".$connection -> escape($this -> iAdmin)."'
                         WHERE UserID =".$connection -> escape($this -> iUserID);
                
                $bSuccess = $connection -> query($sSQL);
                
                if ($bSuccess == false){
                    die($sSQL." fails");
                }
            }
        }
        
        public function __get ($sKey){
            
            switch ($sKey){

                case 'userID':
                return $this -> iUserID;
                    break;
                    
                case 'firstName':
                return $this -> sFirstName;
                    break;
                
                case 'lastName':
                return $this -> sLastName;
                    break;
                
                case 'username':
                return $this -> sUsername;
                    break;
                
                case 'address':
                return $this -> sAddress;
                    break;
                
                case 'email':
                return $this -> sEmail;
                    break;
                
                case 'telephone':
                return $this -> iTelephone;
                    break;
                
                case 'password':
                return $this -> sPassword;
                    break;
                
                case 'admin':
                return $this -> iAdmin;
                    break;
                
                case 'recipes':
                return $this -> aRecipes;
                    break;
                
                default:
                die ($sKey."does not exist.");
            }
        }
        
        public function __set ($sKey, $value){
            
            switch ($sKey){
                
                case 'firstName':
                $this -> sFirstName = $value;
                    break;
                
                case 'lastName':
                $this -> sLastName = $value;
                    break;
                
                case 'username':
                $this -> sUsername = $value;
                    break;
                
                case 'address':
                $this -> sAddress = $value;
                    break;
                
                case 'email':
                $this -> sEmail = $value;
                    break;
                
                case 'telephone':
                $this -> iTelephone = $value;
                    break;
                
                case 'password':
                $this -> sPassword = $value;
                    break;
                
                case 'admin':
                $this -> iAdmin = $value;
                    break;
                
                default:
                die ($sKey."does not exist.");
            }
        }
	}


//testing

//$oUser = new User();
//$oUser -> load(3);
//
//
//
//echo "<pre>";
//print_r($oUser);
//echo "</pre>";


?>