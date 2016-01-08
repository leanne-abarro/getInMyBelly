<?php
    require_once("subscriber.php");
    require_once("form.php");

    // newsletter sign up

    $oNewsletterForm = new Form();

    if (isset($_POST["subscribe"])){
        
        $oNewsletterForm -> data = $_POST;
        
        //form validation
        $oNewsletterForm -> checkFilled("email");
        
        $oTestSubscriber = new Subscriber();
        
        $bLoad = $oTestSubscriber -> loadByEmail($_POST["email"]);
        
        if ($bLoad == true){
            $oNewsletterForm -> raiseCustomError("email","* you are already subscribed");
        } 
        
        if ($oNewsletterForm -> valid == true){
            
            $oSubscriber = new Subscriber();
            
            $oSubscriber -> email = $_POST["email"];
            
            $oSubscriber -> save();
            
            // redirect after adding new page successfully to that new location
            
          if(isset($_SESSION['url'])) 
               $url = $_SESSION['&url']; // holds url for last page visited.
            else 
               $url = "index.php"; // default page for 

            header("Location: $url?message=subscribed"); // perform correct redirect.

          exit; // terminates request
        
        }
    }

    // form markup:

    $oNewsletterForm -> newsletterSubscribeInput("email");
    $oNewsletterForm -> makeSubmit("subscribe","Subscribe","pinkButton bgPink marginLeft10");
?>
<!-- sign up for newsletter -->
            <div class="clearBoth newsLetterSignUp sixteen columns bg3A newsLetter marginRightNone marginBottom50 marginLeftNone">
                <span class="floatLeft paddingLeft20 marginTop5">To receive a bellyful of tasty recipes:</span>
                <div class="floatLeft" >
                    <!-- subscribe form -->
                    <?php
                        echo $oNewsletterForm -> HTML;
                        
                        if(isset($_GET["message"]) == true){

                          if($_GET["message"] == "subscribed"){
                            echo '<div class="formSuccess">You are now subscribed</div>';
                          }

                        }
                    ?> 
                </div>
                
            </div>
            <!-- bottom call to actions -->
            <div class="clearBoth eight columns bottomCta floatLeft marginLeftNone marginBottom50">
                <h3 class="marginBottom10">Got a Recipe?</h3>
                <p>Are you a member and have a healthy recipe you would like to share on Get In My Belly?</p>
                <div class="blueButton2 bgBlue textAlignCenter"><a href="submitRecipe.php">Submit Recipe</a></div>
            </div>
            <div class="eight columns bottomCta floatLeft marginLeftNone marginBottom50">
                <h3 class="marginBottom10">Don't Have an Account?</h3>
                <p>Register below now, so you can have access to purchasing tasty treats for your tummy's needs!</p>
                <div class="blueButton2 bgBlue textAlignCenter"><a href="loginSignUp.php">Sign-Up</a></div>
            </div>
   </div>
   <!-- footer area -->
   <footer class="bg3A">
       <div class="container">
           <ul class="offset-by-five footerNav paddingTop20 marginBottomNone">
               <li class="floatLeft two columns textAlignCenter"><a href="index.php">Home</a></li>
               <li class="floatLeft two columns textAlignCenter"><a href="recipesLanding.php">Recipes</a></li>
               <li class="floatLeft two columns textAlignCenter"><a href="shop.php">Shop</a></li>
           </ul>
           <p class="footNote marginBottomNone textAlignCenter">&copy; Get in my Belly 2015 All Rights Reserved</p>
       </div>
   </footer>
   <script type="text/javascript" src="assets/js/minAndMax8.js"></script>
   <script type="text/javascript" src="assets/js/minAndMax6.js"></script>
   <script type="text/javascript" src="assets/js/activeLink.js"></script>   
</body>
</html>
