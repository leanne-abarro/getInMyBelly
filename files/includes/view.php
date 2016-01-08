<?php
    class View {
    
        static public function renderRecipeNav ($aRecipeTypes){
            
            $sOutput = '<div class="siteNavigation recipeNav selfClear">'."\n";
            $sOutput .= '<ul>'."\n";
            
            for ($iCount = 0; $iCount < count($aRecipeTypes); $iCount++){
                
                $oRecipeType = $aRecipeTypes[$iCount];
                $sOutput .= '<li class="floatLeft textAlignCenter"><a href="recipesCategory.php?RecipeTypeID='.$oRecipeType -> recipeTypeID.'">'.$oRecipeType -> typeName.'</a></li>'."\n";
            }
            
            $sOutput .='</ul>';
            $sOutput .='<div class="blueButton2 bgBlue textAlignCenter marginTopLess10 marginBottom20 floatRight"><a href="submitRecipe.php">Submit Recipe</a></div>'."\n";
            $sOutput .='</div>'."\n";
            
            return $sOutput;
        }
        
        static public function renderRecipeNavDropdown ($aRecipeTypes){
            
            $sOutput = '<ul class="hidden recipeNavDropdown">'."\n";
            
            for ($iCount = 0; $iCount < count($aRecipeTypes); $iCount++){
                
                $oRecipeType = $aRecipeTypes[$iCount];
                $sOutput .= '<li><a href="recipesCategory.php?RecipeTypeID='.$oRecipeType -> recipeTypeID.'">'.$oRecipeType -> typeName.'</a></li>'."\n";
            }
            
            $sOutput .='</ul>';
            
            return $sOutput;
        }
        
        static public function renderRecipes ($aAllRecipes){


            
            $sOutput = "";

            for ($iCount=0; $iCount < count($aAllRecipes); $iCount++){

                $oRecipe = $aAllRecipes[$iCount];

                $bCanLike = false;

                if(isset($_SESSION["UserID"]) == true){

                    $oLike = new Like();
                    $bLoadStatus = $oLike->loadByUserRecipe($_SESSION["UserID"], $oRecipe->recipeID);

                    if($bLoadStatus == false){
                        $bCanLike = true;
                    } 
                }
      
                $oAuthor = new User();
                $oAuthor -> load($oRecipe->userID); // loading the author userID of the recipe

                $sOutput .= '<div class="four columns floatLeft individual marginBottom50">'."\n";
                $sOutput .= '<img class="featureImage marginBottom10" src="images/'.$oRecipe -> imagePath.'" alt="'.$oRecipe -> title.'image" />'."\n";
                $sOutput .= '<h4><a class="featureImageLinks" href="recipePage.php?RecipeID='.$oRecipe -> recipeID.'">'.htmlentities($oRecipe -> title).'</a></h4>'."\n";
                $sOutput .= '<span class="captionLine">Submitted by <span class="authorLine colourPink">'.htmlentities($oAuthor -> firstName).' '.htmlentities($oAuthor -> lastName).'</span></span><br />'."\n";
                
                if($bCanLike == true){
                    $sOutput .= '<div class="likeButton marginTop10"><a href="likeRecipe.php?RecipeID='.$oRecipe -> recipeID.'"><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</a></div>'."\n";

                } else if (isset($_SESSION["UserID"]) && $bCanLike == false) {
                    $sOutput .= '<div class="likeButton bgPink marginTop10"><span><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</span></div>'."\n";
      
                } else {
                    $sOutput .= '<div class="likeButton marginTop10"><a href="likeRecipe.php?RecipeID='.$oRecipe -> recipeID.'"><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</a></div>'."\n";
                }
                          
                $sOutput .= '</div>'."\n";
            }
             return $sOutput;
        }

        static public function renderRecipeType ($oRecipeType){
            
            $aRecipes = $oRecipeType -> recipes;
            
            $sOutput = "";
            for ($iCount=0; $iCount < count($aRecipes); $iCount++){
                
                $oRecipe = $aRecipes[$iCount];

                $bCanLike = false;

                if(isset($_SESSION["UserID"])==true){

                    $oLike = new Like();
                    $bLoadStatus = $oLike->loadByUserRecipe($_SESSION["UserID"], $oRecipe->recipeID);

                    if($bLoadStatus == false){
                        $bCanLike = true;
                    }

                }
      
                $oAuthor = new User();
                $oAuthor -> load($oRecipe->userID); // loading the author userID of the recipe
                
                $sOutput .= '<div class="four columns floatLeft individual marginBottom50">'."\n";
                $sOutput .= '<img class="featureImage marginBottom10" src="images/'.$oRecipe -> imagePath.'" alt="'.$oRecipe -> title.' .image" />'."\n";
                $sOutput .= '<h4><a class="featureImageLinks" href="recipePage.php?RecipeID='.$oRecipe -> recipeID.'">'.htmlentities($oRecipe -> title).'</a></h4>'."\n";
                $sOutput .= '<span class="captionLine">Submitted by <span class="authorLine colourPink">'.htmlentities($oAuthor -> firstName).' '.htmlentities($oAuthor -> lastName).'</span></span><br />'."\n";
                if($bCanLike == true){
                    $sOutput .= '<div class="likeButton marginTop10"><a href="likeRecipe.php?RecipeID='.$oRecipe -> recipeID.'"><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</a></div>'."\n";

                } else if (isset($_SESSION["UserID"]) && $bCanLike == false) {
                    $sOutput .= '<div class="likeButton bgPink marginTop10"><span><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</span></div>'."\n";
      
                } else {
                    $sOutput .= '<div class="likeButton marginTop10"><a href="likeRecipe.php?RecipeID='.$oRecipe -> recipeID.'"><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</a></div>'."\n";
                }
                $sOutput .= '</div>'."\n";
            }
             return $sOutput;
        }
        
        static public function renderRecipePage ($oRecipe){

            $bCanLike = false;

                if(isset($_SESSION["UserID"])==true){

                    $oLike = new Like();
                    $bLoadStatus = $oLike->loadByUserRecipe($_SESSION["UserID"], $oRecipe->recipeID);

                    if($bLoadStatus == false){
                        $bCanLike = true;
                    }

            }
            
            $oAuthor = new User();
            $oAuthor -> load($oRecipe -> userID);
            
            $sOutput = '<h1 class="textAlignCenter marginBottom10">'.htmlentities($oRecipe -> title).'</h1>'."\n";
            $sOutput .= '<span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">Submitted by <span class="authorLine colourPink">'.htmlentities($oAuthor -> firstName).' '.htmlentities($oAuthor -> lastName).'</span></span>'."\n";
            $sOutput .= '<h2 class="textAlignCenter marginTop20">Authors Notes</h2>'."\n";
            $sOutput .= '<p class="marginBottom50 textAlignCenter">'.htmlentities($oRecipe -> authorNotes).'</p>'."\n";
            $sOutput .= '<div class="eight columns floatLeft marginBottom20">'."\n";
            $sOutput .= '<img class="mainImage" src="images/'.$oRecipe -> imagePath.'" alt="'.$oRecipe -> title.' .image" />'."\n";
            $sOutput .= '</div>'."\n";
            $sOutput .= '<div class="eight columns floatLeft mainImage marginBottom20">'."\n";
            
            if($bCanLike == true){
                    $sOutput .= '<div class="likeButton marginTop10"><a href="likeRecipe.php?RecipeID='.$oRecipe -> recipeID.'"><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</a></div>'."\n";

                } else if (isset($_SESSION["UserID"]) && $bCanLike == false) {
                    $sOutput .= '<div class="likeButton bgPink marginTop10"><span><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</span></div>'."\n";
      
                } else {
                    $sOutput .= '<div class="likeButton marginTop10"><a href="likeRecipe.php?RecipeID='.$oRecipe -> recipeID.'"><i class="fa fa-heart marginRight10"></i>'.count($oRecipe->likes).'</a></div>'."\n";
                }
            $sOutput .= '<h3>Ingredients</h3>'."\n";
            $sOutput .= $oRecipe -> ingredients."\n";
            $sOutput .= '</div>'."\n";
            $sOutput .= '<div class="clearBoth sixteen columns marginTop20">'."\n";
            $sOutput .= '<h3>Directions</h3>'."\n";
            $sOutput .= $oRecipe -> directions."\n";
            $sOutput .= '</div>'."\n";
            
            return $sOutput;
        }

        static public function renderRecipeComments ($oRecipe){

            $aComments = $oRecipe -> comments;

            $sOutput = "";

            for ($iCount=0; $iCount < count($aComments); $iCount++) {

               $oComment = $aComments[$iCount];

                $sOutput .= View::renderComment($oComment);
            }

            return $sOutput;

        }


        static public function renderComment($oComment){

           $sOutput = "";

              $oCommenter = new User();
              $oCommenter -> load($oComment->userID);

              $sOutput .='<div class="commentFeed">'."\n";
               $sOutput .='<span class="colour3A floatLeft">'.htmlentities($oCommenter -> firstName).' '.htmlentities($oCommenter -> lastName).'</span>'."\n";
               $sOutput .='<span class="floatRight dayStamp colourPink">'.$oComment -> createdAt.'</span>'."\n";
               $sOutput .='<p class="clearBoth paddingTop20">'.htmlentities($oComment -> comment).'</p>'."\n";
               $sOutput .='<span class="replyCTA"><a class="commentReply" href="#" data-commentid="'.$oComment -> commentID.'">Reply</a></span>'."\n";
               $sOutput .='</div>'."\n";

               $sOutput .= '<div class="marginLeft30">';
               $aReplies = $oComment->replies;
               foreach($aReplies as $oReply){
                    $sOutput .= View::renderComment($oReply);
               }
               $sOutput .='</div>';

           return $sOutput;

       }

        static public function renderProducts ($aAllProducts){
            
            $sOutput = "";
            for ($iCount=0; $iCount < count($aAllProducts); $iCount++){
                
                $oProduct = $aAllProducts[$iCount];

                $sOutput .= '<div class="four columns floatLeft individual marginBottom50">'."\n";
                $sOutput .= '<img class="featureImage marginBottom10" src="images/'.$oProduct -> imagePath.'" alt="'.$oProduct -> description.' .image" />'."\n";
                $sOutput .= '<h4><a class="featureImageLinks" href="shopItem.php?ProductID='.$oProduct -> productID.'">'.htmlentities($oProduct -> productName).'</a></h4>'."\n";
                $sOutput .= '<span class="captionLine">'.htmlentities($oProduct -> description).'<span class="authorLine colourPink">  $'.htmlentities($oProduct -> price).'</span></span><br />'."\n";
                $sOutput .= '<div class="greyButton marginTop10"><a href="shopItem.php?ProductID='.$oProduct -> productID.'">View Item</a></div>'."\n";
                $sOutput .= '</div>'."\n";
            }
             return $sOutput;
        }
        
        static public function renderProductStockMgt ($aAllProducts){
            
            $sOutput = '<div class="mainForms productMgt marginBottom50">'."\n";
            $sOutput .= '<h2 class="paddingTop10 paddingBottom20 marginBottom20 textAlignCenter">Products Currently in the Catalogue</h2>'."\n";
            $sOutput .= '<div class="selfClear">'."\n";
            $sOutput .= '<ul class="productStockTitle">'."\n";
            $sOutput .= '<li class="three columns offset-by-two marginBottom10 colour3A floatLeft">Name</li>'."\n";
            $sOutput .= '<li class="four columns marginBottom10 colour3A floatLeft">Description</li>'."\n";
            $sOutput .= '<li class="two columns offset-by-one marginBottom10 colour3A floatLeft">Price</li>'."\n";
            $sOutput .= '<li class="three columns marginBottom10 colour3A floatLeft">Stock</li>'."\n";
            $sOutput .= '</ul>'."\n";
            
            for ($iCount=0; $iCount < count($aAllProducts); $iCount++){
                
                $oProduct = $aAllProducts[$iCount];
                
                $sOutput .= '<ul class="productStockList clearBoth minimised10 selfClear" id="minimised10">'."\n";
                $sOutput .= '<li class="three columns offset-by-two marginBottom10 floatLeft"><span class="stockTitleSmall">Name: </span>' .htmlentities($oProduct -> productName).'</li>'."\n";
                $sOutput .= '<li class="four columns marginBottom10 floatLeft"><span class="stockTitleSmall">Description: </span>'.htmlentities($oProduct -> description).'</li>'."\n";
                $sOutput .= '<li class="two columns offset-by-one marginBottom10 floatLeft"><span class="stockTitleSmall">Price:</span>$'.htmlentities($oProduct -> price).'</li>'."\n";
                $sOutput .= '<li class="three columns marginBottom10 floatLeft"><span class="stockTitleSmall">Stock Level: </span>'.htmlentities($oProduct -> stockLevel).'</li>'."\n";
                $sOutput .= '</ul>'."\n";
            }
            
            $sOutput .= '</div>'."\n";
            $sOutput .='<div class="blueButton2 bgBlue textAlignCenter marginTop20 marginBottom10"><a href="editProductStock.php">Edit Stock</a></div>'."\n";
            $sOutput .= '</div>'."\n";
            
            return $sOutput;
        }

        static public function renderProductStockMgtEdit ($aAllProducts, $aForms){
            $sOutput = '<h1 class="textAlignCenter marginBottom30">Edit Products</h1>'."\n";
            $sOutput .='<div class="pinkButton bgPink addProductBtn textAlignCenter marginTopLess10 marginBottom20 floatRight selfClear"><a href="addProduct.php">Add Product</a></div>'."\n";
            $sOutput .= '<div class="mainForms stockMgt marginBottom50 selfClear">'."\n";
            $sOutput .= '<h2 class="paddingTop10 paddingBottom20 marginBottom20 textAlignCenter">Stock Level Management</h2>'."\n";
            $sOutput .= '<ul class="selfClear productStockTitle">'."\n";
            $sOutput .= '<li class="three columns offset-by-one marginBottom20 colour3A floatLeft">Name</li>'."\n";
            $sOutput .= '<li class="four columns marginBottom20 colour3A floatLeft">Description</li>'."\n";
            $sOutput .= '<li class="one columns offset-by-one marginBottom20 colour3A floatLeft">Price</li>'."\n";
            $sOutput .= '<li class="four columns offset-by-one marginBottom20 colour3A floatLeft">Stock</li>'."\n";
            $sOutput .= '</ul>'."\n";

            for ($iCount=0; $iCount < count($aAllProducts); $iCount++){
                
                $oProduct = $aAllProducts[$iCount];
                
                $sOutput .= '<ul class="clearBoth">'."\n";
                $sOutput .= '<li class="three columns offset-by-one floatLeft"><span class="stockTitleSmall">Name: </span>'.htmlentities($oProduct -> productName).'</li>'."\n";
                $sOutput .= '<li class="four columns floatLeft"><span class="stockTitleSmall">Description: </span>'.htmlentities($oProduct -> description).'</li>'."\n";
                $sOutput .= '<li class="one columns offset-by-one floatLeft"><span class="stockTitleSmall">Price: </span>$'.htmlentities($oProduct -> price).'</li>'."\n";
                $sOutput .= '<li class="four columns offset-by-one floatLeft"><span class="stockTitleSmall">Stock Level: </span>' .$aForms[$iCount] -> HTML.'</li>'."\n";
                $sOutput .= '</ul>'."\n";
            }

            $sOutput .= '</div>'."\n";
    
            return $sOutput;
        }
        
        static public function renderShopItem ($oProduct,$oBasketForm){
            
            $sOutput = '<h1 class="textAlignCenter marginBottom30">'.htmlentities($oProduct -> description).'</h1>'."\n";
            $sOutput .= '<div class="eight columns floatLeft marginBottom50">'."\n";
            $sOutput .= '<img class="mainImage" src="images/'.$oProduct -> imagePath.'" alt="'.$oProduct -> description.' .image" />'."\n";
            $sOutput .= '</div>'."\n";
            $sOutput .= '<div class="eight columns floatLeft mainImage marginBottom50">'."\n";
            $sOutput .= '<h2 class="marginNone">'.htmlentities($oProduct -> productName).'</h2>'."\n";
            $sOutput .= '<span class="captionLine">'.htmlentities($oProduct -> description).', '.htmlentities($oProduct -> size).'</span>'."\n";
            $sOutput .= '<span class="productPrice colourPink marginTop10 marginBottom100"> $'.htmlentities($oProduct -> price).'</span>'."\n";
            $sOutput .= '<div class="addToBasket marginTop10">'."\n";
            $sOutput .= $oBasketForm -> HTML."\n";
            $sOutput .= '</div>'."\n";
            $sOutput .= '<h3>Ingredients</h3>'."\n";
            $sOutput .= '<p>'.htmlentities($oProduct -> ingredients).'</p>'."\n";
            $sOutput .= '</div>'."\n";
            
            return $sOutput;
        }

        static public function renderShoppingBasket ($oBasket){

           $aContents = $oBasket-> contents;

            $sOutput = '<h1 class="textAlignCenter marginBottom30">Shopping Basket</h1>'."\n";
            $sOutput .= '<div class="mainForms shoppingBasket clearBoth sixteenColumns marginRight10 marginBottom50 marginLeft10 selfClear">'."\n";
            $sOutput .= '<h2 class="paddingTop10 paddingBottom20 textAlignCenter">Basket Items</h2>'."\n";
            
            if (count($aContents) < 1){
                
                $sOutput .='<p class="textAlignCenter">There are currently no items added into the cart</p>'."\n";
                
            } else {
                
                $sOutput .= '<ul class="shoppingCartList">'."\n";
                $sOutput .= '<li class="four columns marginBottom20 colour3A floatLeft">Item Name</li>'."\n";
                $sOutput .= '<li class="four columns marginBottom20 colour3A floatLeft">Item Description</li>'."\n";
                $sOutput .= '<li class="one columns offset-by-two marginBottom20 colour3A floatLeft">Quantity</li>'."\n";
                $sOutput .= '<li class="two columns offset-by-one marginBottom20 colour3A floatLeft">Price</li>'."\n";
                $sOutput .= '</ul>'."\n";
                
                 // looping starts here

                $fTotal = 0;
                $fSubTotal = 0;

                foreach ($aContents as $iProductID => $iQuantity){

                    $oProduct = new Product();
                    $oProduct -> load($iProductID);
                    $fSubTotal = $oProduct -> price * $iQuantity;

                    $sOutput .= '<ul class="clearBoth shoppingBasketItem">'."\n";
                    $sOutput .= '<li class="four columns floatLeft"><span class="stockTitleSmall">Item Name: </span>'.$oProduct -> productName.' <br /><span class="removeCTA"><a href="removeFromBasket.php?ProductID='.$oProduct -> productID.'">REMOVE</a></span></li>'."\n";
                    $sOutput .= '<li class="four columns floatLeft"><span class="stockTitleSmall">Item Description: </span>'.$oProduct -> description.' <br /></li>'."\n";
                    $sOutput .= '<li class="quantityTotal one columns offset-by-two floatLeft textAlignRight"><span class="stockTitleSmall">Quantity: </span>'.$iQuantity.'</li>'."\n";

                    $sOutput .= '<li class="two columns offset-by-one floatLeft"><span class="stockTitleSmall">Item Price: </span>'.$fSubTotal.'</li>'."\n";
                    $sOutput .= '</ul>';

                    $fTotal += $oProduct -> price * $iQuantity; // calculates total of items
                }
                
                $sOutput .= '<ul class="marginBottom20 selfClear">'."\n";
                $sOutput .= '<li class="totalNumber one columns offset-by-ten colour3A floatLeft textAlignRight"><h3>Total</h3></li>'."\n";
                $sOutput .= '<li class="totalNumber two columns offset-by-one floatLeft "><h3>$'.$fTotal.'</h3></li>'."\n";
                $sOutput .= '</ul>'."\n";
                $sOutput .= '<div class="blueButton2 bgBlue textAlignCenter marginBottom20"><a href="shop.php">Continue Shopping</a></div>'."\n";
                $sOutput .= '<div class="blueButton2 bgPink checkOutButton textAlignCenter marginRight10 marginBottom20 floatRight"><a href="checkout.php">Checkout</a></div>'."\n";
            
            }
            
            $sOutput .='</div>';
            
            return $sOutput;
        }
        
        static public function renderCheckoutBasket ($oBasket){
            
            $aContents = $oBasket-> contents;
            
            $sOutput = '<h1 class="textAlignCenter marginBottom30">Checkout</h1>'."\n";
            $sOutput .= '<div class="mainForms checkOutBasket clearBoth sixteenColumns marginBottom50 selfClear">'."\n";
            $sOutput .= '<h2 class="paddingTop10 paddingBottom20 textAlignCenter">Checkout Basket Items</h2>'."\n";
            $sOutput .= '<ul class="shoppingCartList">'."\n";
            $sOutput .= '<li class="eight columns marginBottom20 colour3A floatLeft">Item Description</li>'."\n";
            $sOutput .= '<li class="one columns offset-by-two marginBottom20 colour3A floatLeft">Quantity</li>'."\n";
            $sOutput .= '<li class="two columns offset-by-one marginBottom20 colour3A floatLeft">Price</li>'."\n";
            $sOutput .= '</ul>'."\n";
            
            $fTotal = 0;
            $fSubTotal = 0;
            $fDelivery = 0;
            
            foreach ($aContents as $iProductID => $iQuantity){

                $oProduct = new Product();
                $oProduct -> load($iProductID);
                $fSubTotal = $oProduct -> price * $iQuantity;
                
                $sOutput .='<ul class="clearBoth checkOutBasketItem">'."\n";
                $sOutput .='<li class="eight columns floatLeft"><span class="stockTitleSmall">Item Description: </span>'.$oProduct -> description.' <br /><span class="removeCTA2 removeCTA"><a href="removeFromBasket.php?ProductID='.$oProduct -> productID.'">REMOVE</a></span></li>'."\n";
                $sOutput .='<li class="quantityTotal one columns offset-by-two floatLeft textAlignRight"><span class="stockTitleSmall">Quantity: </span>'.$iQuantity.'</li>'."\n";
                $sOutput .='<li class="two columns offset-by-one floatLeft"><span class="stockTitleSmall">Item Price: </span>'.$fSubTotal.'</li>'."\n";
                $sOutput .='</ul>'."\n";

                $fTotal += $oProduct -> price * $iQuantity; // calculates total of items

                if ($fTotal > 50){

                    $fDelivery = 0;
                } else {

                    $fDelivery = 20;
                }
            
            }
            
            $fTotal2 = $fTotal + $fDelivery;

            $sOutput .= '<ul class="clearBoth">'."\n";
            $sOutput .= '<li class="eight columns floatLeft"></li>'."\n";
            $sOutput .= '<li class="one columns offset-by-two marginBottom20 colour3A floatLeft">Delivery</li>'."\n";
            // $sOutput .= ''."\n";
            $sOutput .= '<li class="two columns offset-by-one floatLeft">'.$fDelivery.'</li>'."\n";
            $sOutput .= '</ul>'."\n";
            $sOutput .= '<ul class="marginBottom20 selfClear">'."\n";
            $sOutput .= '<li class="totalNumber one columns offset-by-ten colour3A floatLeft textAlignRight"><h3>Total</h3></li>'."\n";
            $sOutput .= '<li class="totalNumber two columns offset-by-one floatLeft"><h3>$'.$fTotal2.'</h3></li>'."\n";
            $sOutput .= '</ul>'."\n";
            $sOutput .= '</div>'."\n";
            
            return $sOutput;
        }
        
        static public function renderUserDetails ($oCustomer){
            
//            $password = $oCustomer -> password;
//			$maskedPass = str_repeat("*", strlen($password)); //making password into asterisks
            
            $sOutput = '<div class="mainForms userBox eight columns floatLeft marginBottom30">'."\n";
            $sOutput .= '<h2 class="paddingTop10 paddingBottom20 textAlignCenter">My Details</h2>'."\n";
            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">First Name <span class="bodyText paddingLeft20">'.htmlentities($oCustomer -> firstName).'</span></span>'."\n";
            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">Last Name<span class="bodyText paddingLeft20">'.htmlentities($oCustomer -> lastName).'</span></span>'."\n";
            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">Username<span class="bodyText paddingLeft20">'.htmlentities($oCustomer -> username).'</span></span>'."\n";
            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">Email<span class="bodyText paddingLeft20">'.htmlentities($oCustomer -> email).'</span></span>'."\n";
            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">Address<span class="bodyText paddingLeft20">'.htmlentities($oCustomer -> address).'</span></span>'."\n";
            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">Phone<span class="bodyText paddingLeft20">'.htmlentities($oCustomer -> telephone).'</span></span>'."\n";
//            $sOutput .= '<span class="displayBlock marginBottom10 colour3A">Password<span class="bodyText paddingLeft20">'.$maskedPass.'</span></span>'."\n";
            $sOutput .= '<div class="blueButton2 bgBlue textAlignCenter marginTop10 marginBottom20"><a href="editMyDetails.php">Edit Details</a></div>'."\n";
            $sOutput .= '</div>'."\n";
            
            return $sOutput;
        }
        
        static public function renderUserSubmissions ($oCustomer){
            
            $aRecipes = $oCustomer -> recipes;
            
            $sOutput = '<div class="mainForms userBox eight columns floatLeft marginBottom30">'."\n";
            $sOutput .= '<h2 class="paddingTop10 paddingBottom20 textAlignCenter">Recipe Submissions</h2>'."\n";
            $sOutput .= '<h4>Title</h4>'."\n";
            $sOutput .= '<ul class="marginTop10 minimised6" id="minimised6">'."\n";
            
            for ($iCount=0; $iCount < count($aRecipes); $iCount++){
                
                $oRecipe = $aRecipes[$iCount];
                
                $sOutput .= '<li>'.$oRecipe -> title.' <span class="floatRight marginRight10 editCTA"><a href="editRecipe.php?RecipeID='.$oRecipe -> recipeID.'">EDIT</a></span></li>'."\n";
            }
            
            $sOutput .= '</ul>'."\n";
            $sOutput .='<div class="blueButton2 bgBlue textAlignCenter marginBottom20" id="viewAll2"><a href="">View All</a></div>'."\n";
            $sOutput .= '</div>'."\n";
            
            return $sOutput;
        }
    }
?>
         
              
              
           
       

          
          
          
       
           
       

       
           
           
           
           
       
           
           
            
           
          
                
                
                
                 
                
       