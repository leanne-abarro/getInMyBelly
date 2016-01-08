<?php
    
    require_once("connection.php");
    
    class Order {
        
        private $iOrderID;
        private $tOrderDate;
        private $sOrderStatus;
        private $sRecipientName;
        private $sDelivery;
        private $sBilling;
        private $sPayment;
        private $sAccountName;
        private $iCardNumber;
        private $sExpiry;
        private $iSecurity;
        private $iUserID;
        
        public function __construct (){
            
            $this -> iOrderID = 0;
            $this -> tOrderDate = "";
            $this -> sOrderStatus = "";
            $this -> sRecipientName = "";
            $this -> sDelivery = "";
            $this -> sBilling = "";
            $this -> sPayment = "";
            $this -> sAccountName = "";
            $this -> iCardNumber = 0;
            $this -> sExpiry = "";
            $this -> iSecurity = 0;
            $this -> iUserID = 0;
        }
        
        public function load ($iOrderID){
            
            $connection = new Connection();
            
            $sSQL = "SELECT OrderID, OrderDate, OrderStatus, RecipientName, DeliveryAddress, BillingAddress, Payment, AccountName, CardNumber, ExpiryDate, Security, UserID
                     FROM tborder
                     WHERE OrderID=".$iOrderID;
            
            $resultSet = $connection -> query($sSQL);
            $row = $connection -> fetch_array($resultSet);
            
            //store data in attributes:
            
            $this -> iOrderID = $row["OrderID"];
            $this -> tOrderDate = $row["OrderDate"];
            $this -> sOrderStatus = $row["OrderStatus"];
            $this -> sRecipientName = $row["RecipientName"];
            $this -> sDelivery = $row["DeliveryAddress"];
            $this -> sBilling = $row["BillingAddress"];
            $this -> sPayment = $row["Payment"];
            $this -> sAccountName = $row["AccountName"];
            $this -> iCardNumber = $row["CardNumber"];
            $this -> sExpiry = $row["ExpiryDate"];
            $this -> iSecurity = $row["Security"];
            $this -> iUserID = $row["UserID"];
            
            $connection -> close_connection();
        }
        
        public function save (){
            
            $connection = new Connection();
            
            $a=date("Y-m-d");
            
            $sSQL = "INSERT INTO tborder(OrderDate,OrderStatus, RecipientName, DeliveryAddress, BillingAddress, Payment, AccountName, CardNumber, ExpiryDate, Security, UserID)
                    VALUES ('".$connection -> escape($a)."','".$connection -> escape($this -> sOrderStatus)."','".$connection -> escape($this -> sRecipientName)."','".$connection -> escape($this -> sDelivery)."','".$connection -> escape($this -> sBilling)."','".$connection -> escape($this -> sPayment)."','".$connection -> escape($this -> sAccountName)."','".$connection -> escape($this -> iCardNumber)."','".$connection -> escape($this -> sExpiry)."','".$connection -> escape($this -> iSecurity)."','".$connection -> escape($this -> iUserID)."')";
            
            $bSuccess = $connection -> query($sSQL);

                if ($bSuccess == true){

                        $this -> iOrderID = $connection -> get_insert_id();
                    } else {
                        die($sSQL." fails!");
                }
        }
        
        public function __get ($sKey){
            
            switch ($sKey) {
                
                case 'orderID':
                return $this -> iOrderID;
                break;
                
                case 'orderDate':
                return $this -> tOrderDate;
                break;
                
                case 'orderStatus':
                return $this -> sOrderStatus;
                break;

                case 'recipientName':
                return $this -> sRecipientName;
                break;

                case 'delivery':
                return $this -> sDelivery;
                break;

                case 'billing':
                return $this -> sBilling;
                break;

                case 'payment':
                return $this -> sPayment;
                break;

                case 'accountName':
                return $this -> sAccountName;
                break;

                case 'cardNumber':
                return $this -> iCardNumber;
                break;

                case 'expiry':
                return $this -> sExpiry;
                break;
                
                case 'security':
                return $this -> iSecurity;
                break;

                case 'userID':
                return $this -> iUserID;
                break;
                
                default:
                die($sKey. " does not exist");
                
            }
        }
        
        public function __set ($sKey, $value){
            
            switch ($sKey) {
                
                case 'orderStatus':
                $this -> sOrderStatus = $value;
                break;

                case 'recipientName':
                $this -> sRecipientName = $value;
                break;

                case 'delivery':
                $this -> sDelivery = $value;
                break;

                case 'billing':
                $this -> sBilling = $value;
                break;

                case 'payment':
                $this -> sPayment = $value;
                break;

                case 'accountName':
                $this -> sAccountName = $value;
                break;

                case 'cardNumber':
                $this -> iCardNumber = $value;
                break;

                case 'expiry':
                $this -> sExpiry = $value;
                break;
                
                case 'security':
                $this -> iSecurity = $value;
                break;
                
                case 'userID':
                $this -> iUserID = $value;
                break;
                
                default:
                die($sKey. " does not exist");
                
            }
        }
    }

//testing

// $oOrder = new Order();
// $oOrder -> orderStatus = "Processing";
// $oOrder -> recipientName = "Emily Clarke";
// $oOrder -> userID = 15;
// $oOrder -> delivery = "some street name here";
// $oOrder -> billing = "some street name here";
// $oOrder -> payment = "VISA";
// $oOrder -> accountName = "Emily Clarke";
// $oOrder -> cardNumber = 123456789442;
// $oOrder -> expiry = "13/18";
// $oOrder -> security = 345;

// $oOrder -> save();

// print_r($oOrder);
?>