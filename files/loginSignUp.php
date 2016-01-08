<?php
    require_once("includes/header.php");
    require_once("includes/form.php");
    require_once("includes/subscriber.php");
    
    // login form

    $oForm1 = new Form();

    if (isset($_POST["signIn"])) {

      $oForm1 -> data = $_POST;

      // form validation
      $oForm1 -> checkFilled("username");
      $oForm1 -> checkFilled("password");

      $oTestCustomer = new User();

      $bLoad = $oTestCustomer -> loadByUsername($_POST["username"]);

      if ($bLoad == false){
        $oForm1 -> raiseCustomError("username","* the username does not exist");
      } else {

        if (password_verify($_POST["password"],$oTestCustomer -> password) == false ){ // incorrect password
          $oForm1 -> raiseCustomError("password","* incorrect password");
        } else {

          $_SESSION["UserID"] = $oTestCustomer -> userID;
            
          $oBasket = new Basket();
          $_SESSION["basket"] = $oBasket; // creates cart when a session starts
                
          // redirect after adding new page successfully to that new location
          header("Location:index.php");
          exit; // terminates request
        }
      }
    }

    // form markup:
    $oForm1 -> makeInput("username","Username","clearBoth");
    $oForm1 -> makePassword("password","Password","clearBoth");
    $oForm1 -> makeSubmit("signIn","Sign-In","blueButton2 bgBlue marginBottom10");

    // sign up form

    $oForm2 = new Form();

    if (isset($_POST["create"])){

      $oForm2 -> data = $_POST;
      
      // form validation:

      $oForm2 -> checkFilled("firstName");
      $oForm2 -> checkFilled("lastName");
      $oForm2 -> checkFilled("username");
      $oForm2 -> checkFilled("email");
      $oForm2 -> checkFilled("address");
      $oForm2 -> checkFilled("telephone");
      $oForm2 -> checkFilled("password");
      $oForm2 -> checkFilled("confirmPassword");
      $oForm2 -> compare("password","confirmPassword");

      $oTestCustomer = new User(); // testing if username exists in database
      $bLoad = $oTestCustomer -> loadByUsername($_POST["username"]); // what username is posted

      if ($bLoad == true){

        $oForm2 -> raiseCustomError("username","* this username already exists"); // calls raiseCustomError message
      }

      if ($oForm2 -> valid == true){ //no errors, therefore creates new user in system:

        $oCustomer = new User();

        $oCustomer -> firstName = $_POST["firstName"];
        $oCustomer -> lastName = $_POST["lastName"];
        $oCustomer -> username = $_POST["username"];
        $oCustomer -> email = $_POST["email"];
        $oCustomer -> address = $_POST["address"];
        $oCustomer -> telephone = $_POST["telephone"];
        $oCustomer -> password = password_hash($_POST["password"],PASSWORD_DEFAULT);

        $oCustomer -> save();

        $oSubscriber = new Subscriber();

        if (isset($_POST["newsSignUp"])){
          $oSubscriber -> email = $_POST["email"];
        }

        $oSubscriber -> save();

        // redirect after adding new page successfully to that new location

      header("Location:loginSignUp.php?message=created"); // will prompt message to come up
      exit; // terminates request

      }

    }

    // form markup:
    $oForm2 -> makeInput("firstName","First Name *","doubleColumn heightApplied floatLeft");
    $oForm2 -> makeInput("lastName","Last Name *","doubleColumn heightApplied floatLeft");
    $oForm2 -> makeInput("username","Username *","doubleColumn heightApplied floatLeft ");
    $oForm2 -> makeInput("email","Email *","doubleColumn heightApplied floatLeft ");
    $oForm2 -> makeInput("address","Address *","doubleColumn heightApplied floatLeft ");
    $oForm2 -> makeInput("telephone","Telephone *","doubleColumn heightApplied floatLeft");
    $oForm2 -> makePassword("password","Password *","doubleColumn heightApplied floatLeft");
    $oForm2 -> makePassword("confirmPassword","Confirm Password *","doubleColumn heightApplied floatLeft");
    $oForm2 -> makeCheckBox("newsSignUp","Subscribe to the Get in my Belly Newsletter");
    $oForm2 -> makeSubmit("create","Create","blueButton2 bgBlue marginBottom10");
?>
       <h1 class="textAlignCenter marginBottom30">User Login</h1>
       <!-- login form -->
       <div class="mainForms eight columns floatLeft marginBottom50">
           <h2 class="formHeader paddingTop10 paddingBottom20">Login</h2>
           <?php
                echo $oForm1 -> HTML;
           ?>
       </div>
       
       <!-- sign up form -->
       <div class="mainForms2 eight columns floatLeft marginBottom50" >
           <h2 class="formHeader paddingTop10 paddingBottom20">Create Account</h2>
           <span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">* Required Fields </span>
           <?php
                echo $oForm2 -> HTML;

                if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "created"){
                    echo '<div class="formSuccess">You are now registered. Please login</div>';
                  }

                }
           ?>
       </div>
       
          
<?php
  require_once("includes/footerAdmin.php");
?>