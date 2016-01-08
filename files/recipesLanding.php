<?php
    require_once("includes/header.php");
    require_once("includes/recipeManager.php");


    $aAllRecipes = RecipeManager::getAllRecipes();

?>
     <!-- recipes type nav -->
      <?php
        echo View::renderRecipeNav($aAllTypes);
      ?>
       
       <h1 class="textAlignCenter marginBottom30">
           Recipes
       </h1>

       <!-- latest shop items section -->
       <div class="clearBoth floatLeft">
            <h3 class="marginBottom30">Latest Recipes</h3>
            <div id="minimised8" class="minimised8 singleBlock">
              <?php
                  echo View::renderRecipes($aAllRecipes);
              ?>
            </div>
       </div>
       <div class="blueButton2 bgBlue textAlignCenter marginBottom20" id="viewAll"><a href="">View All</a></div>

<?php
    require_once("includes/footer.php");
?>