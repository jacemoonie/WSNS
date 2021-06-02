<?php 

if(is_post_request()){
    if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
        $fname=FormSanitizer::formSanitizerName($_POST['firstName']);
        $lname=FormSanitizer::formSanitizerName($_POST['lastName']);
        $email=FormSanitizer::formSanitizerString($_POST['email']);
        $pass=FormSanitizer::formSanitizerString($_POST['password']);
        $pass2=FormSanitizer::formSanitizerString($_POST['password2']);
        $username=$account->generateUsername($fname,$lname);

        $wasSuccessful = $account->register($fname,$lname,$username,$email,$pass,$pass2);
        
        // if register successful
        if($wasSuccessful){
            // echo "User registered!";
            // start session
            $_SESSION['userLoggedIn'] = $wasSuccessful;

            // if(isset($_POST['remember'])){
            //     $_SESSION['rememberMe'] = $_POST['remember'];
            // }

            //Email verification
            redirect_to(url_for("verification"));

        }else{

            //if failed to register
            echo '
            <script>

            $(document).ready(function() {
              $("#signupModal").modal("show");
            });
            
            </script>';
        }
   }
}


?>