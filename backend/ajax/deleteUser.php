<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['userId']) && !empty($_POST['userId'])){
        
        $userId = h($_POST['userId']);

        $deleteUser = $loadFromUser->delete("users",array("user_id"=>$userId));

        if($deleteUser){
            echo $loadFromUser->allUserData();
        }else{
            echo "failed";
        }
         

    }
        
    
}

?>