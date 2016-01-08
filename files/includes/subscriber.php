<?php
	require_once("connection.php");

	class Subscriber {

		private $iSubscriberID;
		private $sEmail;

		public function __construct (){

			$this -> iSubscriberID = 0;
			$this -> sEmail = "";
		}
        
        public function load ($iSubscriberID){
            $connection = new Connection();
            $sSQL = "SELECT SubscriberID, Email
                     FROM tbnewsletter
                     WHERE SubscriberID=".$iSubscriberID;
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);
            
            //store data into attributes:
            
            $this -> iSubscriberID = $row['SubscriberID'];
            $this -> sEmail = $row['Email'];
            
            $connection -> close_connection();
        
        }
        
        public function loadByEmail ($sEmail){ // checks if email already exists in database
            
            $connection = new Connection();
            $sSQL = "SELECT SubscriberID
                     FROM tbnewsletter
                     WHERE Email='".$connection -> escape($sEmail)."'";
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);
            
            if ($row == false){ // if user hasn't subscribed

                return false;

            } else {
                $this -> load($row['SubscriberID']); // if user has already subscribed

                return true;
            }
        }

		public function save (){

            $connection = new Connection();
            $sSQL = "INSERT INTO tbnewsletter(Email)
                     VALUES ('".$connection -> escape($this -> sEmail)."')";

            $bSuccess = $connection -> query($sSQL);

            if ($bSuccess == true){

                    $this -> iSubscriberID = $connection -> get_insert_id();
                } else {
                    die($sSQL." fails!");
                }
        }
        
        public function __get ($sKey){
                switch ($sKey){
                    
                    case 'subscriberID':
                    return $this -> iSubscriberID;
                        break;

                    case 'email':
                    return $this -> sEmail;
                        break;

                    default:
                    die ($sKey." does not exist.");
                }
            } 

        public function __set ($sKey, $value){
                switch ($sKey){

                    case 'email':
                    $this -> sEmail = $value;
                        break;

                    default:
                    die ($sKey." does not exist.");
                }
            } 

	}

	//testing

	// $oSubscriber = new Subscriber();

	// $oSubscriber -> email = "leanne.abarro@gmail.com";

	// $oSubscriber -> save();

	// print_r($oSubscriber);

?>