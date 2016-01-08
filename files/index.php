<?php
  require_once("includes/header.php");
  require_once("includes/recipeManager.php");
  require_once("includes/productManager.php");


  $aAllRecipes = RecipeManager::getAllRecipes();
  $aAllProducts = ProductManager::getAllProducts();
?>
     <h1 class="textAlignCenter">"Get In My Belly!"</h1>
     <ul class="header1Home textAlignCenter marginBottom50">
         <li class="bodyTextItalic">1. a phrase one says to express enjoyment of good food.</li>
         <li class="marginNone bodyTextItalic">2. the go-to healthy (gr)hub to satisfy the rumblings of a hungry belly.</li>
     </ul>
     <!-- main call-to-actions section -->
     <div class="mainImageHome eight columns floatLeft">
         <img src="images/homeCookImage.jpg" alt="recipes-call-to-action-image" />
         <div class="overlay">
             <i class="fa fa-cutlery displayBlock headerIcon colour3A paddingTop50"></i>
             <h2 class="textAlignCenter paddingTop10">Make</h2>
             <p class="textAlignCenter colour44">A collection of healthy recipes, fit for hungry tastebuds.</p>
             <div class="blueButton bgBlue textAlignCenter"><a href="recipesLanding.php">See Recipes</a></div>
         </div>
     </div>
     <div class="mainImageHome eight columns floatLeft">
         <img src="images/homeBuyImage.jpg" alt="shop-call-to-action-image" />
         <div class="overlay">
             <i class="fa fa-tag displayBlock headerIcon colour3A paddingTop50"></i>
             <h2 class="textAlignCenter paddingTop10">Buy</h2>
             <p class="textAlignCenter colour44">Feel-good eats to satisfy cravings.</p>
             <div class="blueButton bgBlue textAlignCenter"><a href="shop.php">Shop Now</a></div>
         </div>
     </div>
     <!-- latest recipes and shop items section -->
     <div class="clearBoth floatLeft">
          <h3 class="marginBottom30">Latest Recipes</h3>
          <div class="minimised2 singleBlock selfClear">
              <?php
                  echo View::renderRecipes($aAllRecipes);
              ?>
          </div>
     </div>
     <div class="floatLeft">
         <h3 class="marginBottom30">New in Store</h3>
         <div class="minimised2 singleBlock selfClear">
              <?php
                  echo View::renderProducts($aAllProducts);              ?>
          </div>
     </div>
<?php
  require_once("includes/footer.php");
?>
