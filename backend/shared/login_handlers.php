<?php 
if(isset($_SESSION['userLoggedIn'])){
    redirect_to(url_for("home"));
}else if(Login::isLoggedIn()){
    redirect_to(url_for("home"));
}

if(is_post_request()){
   
    if(isset($_POST['username']) && !empty($_POST['username'])){
        
        $username=FormSanitizer::formSanitizerName($_POST['username']);
        $pass=FormSanitizer::formSanitizerString($_POST['password']);

        $wasSuccessful = $account->login($username,$pass);
        if($wasSuccessful){
            $user_id = $wasSuccessful;
            $_SESSION['userLoggedIn'] = $wasSuccessful;
            //set users status to online
            $status = 1;
            $loadFromUser->update("users",$user_id,array("userStatus"=>$status));
            if($loadFromUser){
                redirect_to(url_for("home"));
            }
            

        }
    }

}

?>