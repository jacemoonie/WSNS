<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
        
        $fn = h($_POST['firstName']);
        $userId = h($_POST['userId']);


        $updateProfile = $loadFromUser->update("users",$userId,["firstName"=>$fn]);
         

       echo $updateProfile;
    }
        
    
}

?>