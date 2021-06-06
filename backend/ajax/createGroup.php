<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['groupCreatedBy']) && !empty($_POST['groupCreatedBy'])){
        $groupCreatedBy = h($_POST['groupCreatedBy']);
        $groupName = h($_POST['groupName']);
        $groupDescription = h($_POST['groupDescription']);
        $groupMembers = json_decode($_POST['groupMembers']);
        $groupImage = "frontend\assets\images\default_profile.png";
        
        
        $createGroup = $loadFromUser->create("`group`",array("groupName"=>$groupName,"groupDescription"=>$groupDescription,"groupCreatedBy"=>$groupCreatedBy,"groupImage"=>$groupImage));
        if($createGroup){
            // echo "Group created";
            $groupData = $loadFromGroup->groupData($groupCreatedBy,$groupName);
            if($groupData){
                // var_dump($groupData);
                foreach($groupMembers as $member){
                    // echo $member;
                    $insertMember = $loadFromUser->create("groupMembers",array("user_id"=>$member,"group_id"=>$groupData->groupID));
                    if($insertMember){
                        // echo "MEMBER INSERTED";
                    }
                    else{
                        echo "FAILED";
                    }
                }
            }else{
                echo "FAILED";
            }
        }
        else{
            echo "FAILED";
        }
        echo $groupData->groupID;
    }
    
}

?>