<?php
require_once '../initialize.php';

if(is_post_request()){
    
    if(isset($_POST['groupEditMembers']) && !empty($_POST['groupEditMembers'])){
        
        $groupid = h($_POST['groupEditMembers']);
        $userid = h($_POST['userid']);

        $groupData = $loadFromGroup->groupDataByID($groupid);
        if($groupData){
            
            echo json_encode($groupData);
           
        }else{
            echo "FAILED TO FETCH DATA";
        }
    }
        
    
}

?>