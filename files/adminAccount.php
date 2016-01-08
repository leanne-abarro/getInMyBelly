<?php 
    require_once("includes/header.php");
    require_once("includes/product.php");
    require_once("includes/productManager.php");
    require_once("includes/view.php");

    $aAllProducts = ProductManager::getAllProducts();
?>

       <h1 class="textAlignCenter marginBottom30">Admin Account</h1>
       <div class="pinkButton bgPink addProductBtn textAlignCenter marginTopLess10 marginBottom20 floatRight selfClear"><a href="addProduct.php">Add Product</a></div>
       <!-- products section -->
       <?php
            echo View::renderProductStockMgt($aAllProducts);
       ?>
       
<?php 
    require_once("includes/footerAdmin.php");
?>
