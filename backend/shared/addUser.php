<?php 

if(is_post_request()){
    if(isset($_POST['a-firstName']) && !empty($_POST['a-firstName'])){
        $fname=FormSanitizer::formSanitizerName($_POST['a-firstName']);
        $lname=FormSanitizer::formSanitizerName($_POST['a-lastName']);
        $email=FormSanitizer::formSanitizerString($_POST['a-email']);
        $pass=FormSanitizer::formSanitizerString($_POST['a-password']);
        $pass2=FormSanitizer::formSanitizerString($_POST['a-password2']);
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