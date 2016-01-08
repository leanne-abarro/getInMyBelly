<?php
    require_once("includes/header.php");

    if (isset($_SESSION["UserID"]) == false){ // if user hasn't logged on

    // redirect back to login if user has not logged on.
      header("Location:loginSignUp.php");
      exit; // terminates request
    }
    
    $oCustomer = new User();
    $oCustomer -> load($_SESSION["UserID"]);
?>
       <h1 class="textAlignCenter marginBottom30">My Account</h1>
       <?php
            // my details
            echo View::renderUserDetails($oCustomer);
            
            // recipe submissions
            echo View::renderUserSubmissions($oCustomer);
       ?>
         
<?php
    require_once("includes/footerAdmin.php");
?>