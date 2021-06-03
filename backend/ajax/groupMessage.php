<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['groupCreatedBy']) && !empty($_POST['groupCreatedBy'])){
        $groupCreatedBy = h($_POST['groupCreatedBy']);
        $groupName = h($_POST['groupName']);
        $groupDescription = h($_POST['groupDescription']);
        
        echo $loadFromUser->create("group",array("groupName"=>$groupName,"groupDescription"=>$groupDescription,"groupCreatedBy"=>$groupCreatedBy))

        
       
    }
    
}

?>