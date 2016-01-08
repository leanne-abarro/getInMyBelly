<?php
    require_once("product.php");
    
    class Basket {
        private $aContents;

        
        public function __construct (){
            $this -> aContents = array();

        }
        
        public function add($iProductID,$iQuantity){

            if(isset($this->aContents[$iProductID]) == false){
                $this->aContents[$iProductID] = $iQuantity;
            }else{

                $this->aContents[$iProductID] += $iQuantity;

            }
            
            // if ($iProductID < 1 or $iQuantity < 1){ // nothing is added
            //     return;
            // }
            
            // if(is_array($this -> aContents)){ // if there is already a session basket that has started
                
            //     if($this->productAdded($iProductID)){ //if a product already exists in basket array
            //         $this -> aContents[0]['quantity'] = $iQuantity;
            //         return;
            //     }
                
            //     // add product and quantity:
            //     $iIndex = count($this -> aContents);// index = count of the array
            //     $this -> aContents[$iIndex]['productID']= $iProductID;
            //     $this -> aContents[$iIndex]['quantity'] = $iQuantity;
                
            // } else {
            //     $this -> aContents; // if session basket has not started
            //     $this -> aContents[0]['productID']= $iProductID;
            //     $this -> aContents[0]['quantity'] = $iQuantity;
            // }
           
        }

        public function update($iProductID,$iQuantity){

    
            $this->aContents[$iProductID] = $iQuantity;
            if($iQuantity == 0){
                $this->remove($iProductID);
            }
           
        }
        
        // function productAdded($iProductID){
        //         $iIndex = count($this -> aContents);
        //         $flag = 0;

        //         for ($iCount = 0; $iCount < $iIndex; $iCount++){ 
        //             if ($iProductID == $this -> aContents[$iCount]['productID']){ // if product already exists
        //                  $iQuantity = $this -> aContents[$iCount]['quantity']; //updates quantity
        //                 $flag = 1;
        //                 break;
        //             }
        //         }
                
        //         return $flag;
        // }
        
        public function remove($iProductID){

            unset($this->aContents[$iProductID]);
            
            // $iIndex=count($this -> aContents);
            // for($iCount = 0; $iCount < $iIndex; $iCount++){
            //     if($iProductID == $this -> aContents[$iCount]['productID']){
            //         unset($this -> aContents[$iCount]);
            //         break;
            //     }
            // }
            // $this -> aContents = array_values($this -> aContents);
        }


        public function __get ($sKey){
            
            switch ($sKey){
                
                case 'contents':
                return $this -> aContents;
                break;
                
                default:
                die ($sKey." does not exist");
            }
        }
        
        public function __set ($sKey, $value){
            
            switch ($sKey){
                
                case 'contents':
                $this -> aContents = $value;
                break;
                
                default:
                die ($sKey." does not exist");
            }
        }
        
    }

        

    //testing


    
//     $oBasket = new Basket();


//     $oBasket -> add(10,1);
//     $oBasket -> add(2,4);
//     $oBasket -> add(10,2);
//     $oBasket -> add(2,1);
//     $oBasket -> remove(2);
// $oBasket -> add(10,5);
// $oBasket -> add(10,10);
// $oBasket -> add(10,9);



//   	print_r($oBasket);


?>