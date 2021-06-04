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
        if(!$wasSuccessful){
            //if failed to register
            echo '
            <script>

            $(document).ready(function() {
              $("#createUserModal").modal("show");
            });
            
            </script>';
        }
   }
}


?>