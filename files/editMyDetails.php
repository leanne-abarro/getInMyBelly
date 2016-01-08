<?php
    require_once("includes/header.php");

    require_once("includes/form.php");

    if (isset($_SESSION["UserID"]) == false){ // if user hasn't logged on

    // redirect back to login if user has not logged on.
      header("Location:loginSignUp.php");
      exit; // terminates request
    }
    
    $oCustomer = new User();
    $oCustomer -> load($_SESSION["UserID"]);

    $aExistingData = array();
    
    $aExistingData["firstName"] = $oCustomer -> firstName;
    $aExistingData["lastName"] = $oCustomer -> lastName;
    $aExistingData["username"] = $oCustomer -> username;
    $aExistingData["email"] = $oCustomer -> email;
    $aExistingData["address"] = $oCustomer -> address;
    $aExistingData["telephone"] = $oCustomer -> telephone;
    $aExistingData["password"] = $oCustomer -> password;

    // edit my details form

    $oForm1 = new Form();
    
    $oForm1 -> data = $aExistingData;
    
    if (isset($_POST["updateDetails"])){
        $oForm1 -> data = $_POST;
        
        //form validation:
        
        $oForm1 -> checkFilled("firstName");
        $oForm1 -> checkFilled("lastName");
        $oForm1 -> checkFilled("username");
        $oForm1 -> checkFilled("email");
        $oForm1 -> checkFilled("address");
        $oForm1 -> checkFilled("telephone");
        
        if ($oForm1 -> valid == true){

			//updating details

			$oCustomer -> firstName = $_POST["firstName"];
			$oCustomer -> lastName = $_POST["lastName"];
			$oCustomer -> username = $_POST["username"];
      $oCustomer -> email = $_POST["email"];
			$oCustomer -> address = $_POST["address"];
			$oCustomer -> telephone = $_POST["telephone"];

			$oCustomer -> save();

			// redirect after adding new page successfully to that new location

			header("Location:editMyDetails.php?message=updated");
			exit; // terminates request
		}
    }

    // html markup:
    $oForm1 -> makeInput("firstName","First Name *","doubleColumn heightApplied floatLeft");
    $oForm1 -> makeInput("lastName","Last Name *","doubleColumn heightApplied floatLeft");
    $oForm1 -> makeInput("username","Username *","doubleColumn heightApplied floatLeft");
    $oForm1 -> makeInput("email","Email *","doubleColumn heightApplied floatLeft");
    $oForm1 -> makeInput("address","Address *","doubleColumn heightApplied floatLeft");
    $oForm1 -> makeInput("telephone","Telephone *","doubleColumn heightApplied floatLeft");
    $oForm1 -> makeSubmit("updateDetails","Update Details","blueButton2 bgBlue marginBottom10");

    // change password form

    $oForm2 = new Form();
    $oForm2 -> data = $aExistingData;

    if (isset($_POST["changePassword"])){
        
        $oForm2 -> data = $_POST;
        
        // form validation:
        
        $oForm2 -> checkFilled("password");
        $oForm2 -> checkFilled("confirmPassword");
        $oForm2 -> checkFilled("currentPassword");
        $oForm2 -> compare("password","confirmPassword");
        
        if (password_verify($_POST["currentPassword"],$oCustomer -> password) == false){ // incorrect password
          $oForm2 -> raiseCustomError("currentPassword","* incorrect password");
        }
        if ($oForm2 -> valid == true){
            
            $oCustomer -> password = password_hash($_POST["password"],PASSWORD_DEFAULT);
            
            $oCustomer -> save();
            // redirect after adding new page successfully to that new location

			header("Location:editMyDetails.php?message=passwordChanged");
			exit; // terminates request
            
        }
        
        
    }
    
    // html markup:

        $oForm2 -> makePasswordBlank("password","New Password *");
        $oForm2 -> makePasswordBlank("confirmPassword","Confirm Password *");
        $oForm2 -> makePasswordBlank("currentPassword","Current Password");
        $oForm2 -> makeSubmit("changePassword","Change Password","displayBlock clearBoth blueButton2 bgBlue marginTop10 marginBottom10");
?>
       <h1 class="textAlignCenter marginBottom30">Edit My Account</h1>
       <!-- my details -->
        <div class="mainForms2 eight columns floatLeft marginBottom50" >
           <h2 class="paddingTop10 paddingBottom20 textAlignCenter">Edit My Details</h2>
              <span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">* Required Fields </span>
           <?php
                echo $oForm1 -> HTML;

                if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "updated"){
                    echo '<div class="formSuccess">Your details have now been updated.</div>';
                  }

                }
            ?>
       </div>
       <!-- change password -->
       <div class="mainForms2 eight columns floatLeft marginBottom50">
           <h2 class="paddingTop10 paddingBottom20 textAlignCenter">Change Password</h2>
              <span class="displayBlock positionRelative recipeCaption captionLine textAlignCenter marginBottom10">* Required Fields </span>
              
           <?php
                echo $oForm2 -> HTML;
                
                if(isset($_GET["message"]) == true){

                  if($_GET["message"] == "passwordChanged"){
                    echo '<div class="formSuccess">Your password has now been changed.</div>';
                  }

                }
           ?>   
       </div>
<?php
    require_once("includes/footerAdmin.php");
?>
