<?php
    require_once("includes/header.php");
    require_once("includes/product.php");
    require_once("includes/productManager.php");
    require_once("includes/form.php");

    $oProductForm = new Form();
    
    if (isset($_POST["add"])){
        
        $oProductForm -> data = $_POST;
        $oProductForm -> files = $_FILES;
        
        $oProductForm -> checkFilled("productName");
        $oProductForm -> checkFilled("productDescription");
        $oProductForm -> checkFileUpload("imageUpload");
        $oProductForm -> checkFilled("productSize");
        $oProductForm -> checkFilled("productPrice");
        $oProductForm -> checkFilled("ingredients");
        $oProductForm -> checkFilled("stockLevel");
        
        if ($oProductForm -> valid == true){
            
            $oProduct = new Product();
            
            //save details:
            
            $sImageName = "productImage-".date("Y-m-d-H-i-s").".jpg";
			
            $oProductForm -> moveFile("imageUpload",$sImageName);
            
            $oProduct -> productName = $_POST["productName"];
            $oProduct -> description = $_POST["productDescription"];
            $oProduct -> imagePath = $sImageName;
            $oProduct -> size = $_POST["productSize"];
            $oProduct -> price = $_POST["productPrice"];
            $oProduct -> ingredients = $_POST["ingredients"];
            $oProduct -> stockLevel = $_POST["stockLevel"];
            
            $oProduct -> save();
            
            header("Location: addProduct.php?message=added");
			exit;
        }
    }

    //html markup
    $oProductForm -> makeInput("productName","Product Name *","eight columns floatLeft marginBottom10");
    $oProductForm -> makeInput("productDescription","Product Description *","eight columns floatLeft marginBottom10");
    $oProductForm -> makeImageUpload("imageUpload","Image Upload *");
    $oProductForm -> makeInput("productSize","Product Size *","eight columns floatLeft marginBottom10");
    $oProductForm -> makeInput("productPrice","Product Price *","eight columns floatLeft marginBottom10");
    $oProductForm -> makeTextArea("ingredients","Ingredients *","eight columns floatLeft marginBottom10 selfClear");
    $oProductForm -> quantityInput("stockLevel","Stock Level *","addStockLevel");
    $oProductForm -> makeSubmit("add","Add Product","clearBoth blueButton bgBlue marginBottom30");
    
?>
       <h1 class="textAlignCenter marginBottom30">Add a Product</h1>
       <span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">* Required Fields </span>
       <!-- add product form starts here -->
       <div class="otherForms addProductForm">
           <?php
                echo $oProductForm -> HTML;
                
                if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "added"){
                    echo '<div class="formSuccess">New Product added succesfully!</div>';
                  }

                } 
           ?>
       </div>
       
<?php
    require_once("includes/footerAdmin.php");
?>
