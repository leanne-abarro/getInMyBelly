<?php
    require_once("includes/header.php");
    require_once("includes/product.php");
    require_once("includes/productManager.php");

    $aAllProducts = ProductManager::getAllProducts();
?>
       <h1 class="textAlignCenter marginBottom30">Shop</h1>

       <!-- latest shop items section -->
       <div class="clearBoth floatLeft">
            <h3 class="marginBottom30">New in Store</h3>
            <div class="minimised8 singleBlock" id="minimised8">
            <?php
                echo View::renderProducts($aAllProducts);
            ?>
            </div>
       </div>
       <div class="blueButton2 bgBlue textAlignCenter marginBottom20" id="viewAll"><a href="">View All</a></div>
<?php
    require_once("includes/footer.php");
?>
           