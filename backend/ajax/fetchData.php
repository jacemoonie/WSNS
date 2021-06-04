<?php
require_once '../initialize.php';

if(is_post_request()){
    
    if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
        
        $user_id = h($_POST['user_id']);
        $userData = $loadFromUser->userData($user_id);
        if($userData){
            
             echo json_encode($userData);
        }
    }
        
    
}

?>