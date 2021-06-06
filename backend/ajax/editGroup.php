<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['removeMemberid']) && !empty($_POST['removeMemberid'])){
        echo $userId = h($_POST['removeMemberid']); //40
        echo $groupId = h($_POST['fromGroupid']); //11

        if(!empty($userId && !empty($groupId))){
            $removeUserFromGroup = $loadFromUser->delete("groupmembers",["user_id"=>$userId,"group_id"=>$groupId]);
            if($removeUserFromGroup){
                echo "MEMBER REMOVED";
            }else{
                echo "FAILED TO REMOVE MEMBER";
            }
        }   

    }

    if(isset($_POST['addMemberid']) && !empty($_POST['addMemberid'])){
        $userId = h($_POST['addMemberid']); //40
        $groupId = h($_POST['fromGroupid']); //11

        if(!empty($userId) && !empty($groupId)){
            //CHECK iF ID ALREADY EXIST 
            $allMember = $loadFromGroup->groupMembers($groupId);
            foreach($allMember as $member){
                if($member->user_id == $userId){
                    $exist = true;
                    break;
                }else{
                    $exist = false;
                }
            }

            if($exist != true){
                echo 0;
                $addMemberIntoGroup = $loadFromUser->create("groupmembers",["user_id"=>$userId,"group_id"=>$groupId]);
            }else{
                echo 1; 
            }
        }   

    }

    if(isset($_POST['update']) && !empty($_POST['update'])){
        echo $userId = h($_POST['userid']);
        echo $groupId = h($_POST['update']);
        echo $groupName = h($_POST['groupName']);
        echo $groupDescription = h($_POST['groupDescription']);

        if(!empty($userId && !empty($groupId))){
            $updateGroupData = $loadFromGroup->updateGroupData("`group`",$groupId,["groupName"=>$groupName,"groupDescription"=>$groupDescription]);
            if($updateGroupData){
                echo "DATA UPDATED";
            }else{
                echo "FAILED TO UPDATE DATA";
            }
            
        }   

    }
        
    
}

?>