<?php
    require_once("includes/header.php");
    
    $iRecipeTypeID = 1;
    
    if(isset($_GET["RecipeTypeID"])){
		$iRecipeTypeID = $_GET["RecipeTypeID"];
	}
    
	$oRecipeType = new RecipeType();
	$oRecipeType ->load($iRecipeTypeID);

?>
     <!-- recipes type nav -->
      <?php
        echo View::renderRecipeNav($aAllTypes);
      ?>
       
       <h1 class="textAlignCenter marginBottom30">
           <?php echo $oRecipeType -> typeName .' '?>Recipes
       </h1>

       <!-- latest shop items section -->
       <div class="clearBoth floatLeft">
            <h3 class="marginBottom30">Latest Recipes</h3>
            <div class="minimised8 singleBlock" id="minimised8">
              <?php
                  echo View::renderRecipeType($oRecipeType);
              ?>
            </div>
       </div>
       <div class="blueButton2 bgBlue textAlignCenter marginBottom20" id="viewAll"><a href="">View All</a></div>

<?php
    require_once("includes/footer.php");
?>