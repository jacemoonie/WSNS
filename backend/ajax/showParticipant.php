<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['showParticipant']) && !empty($_POST['showParticipant'])){
        $userid = h($_POST['showParticipant']);

        if(!empty($userid)){
            $user = $loadFromUser->userData($userid);
            echo '
            <div class="participant-info" id="participant-info">
                <span data-muid ="'.$user->user_id.'" class="participant-name">'.$user->firstName.' '.$user->lastName.'</span>
                <span data-uid ="'.$user->user_id.'"class="cancel-participant">X</span>
            </div>';
        }
        
    }
    if(isset($_POST['showMembers']) && !empty($_POST['showMembers'])){
        
        $groupMembers = json_decode($_POST['showMembers']);

        if(!empty($groupMembers)){
            foreach($groupMembers as $member){
                $user = $loadFromUser->userData($member);
                echo '
                <div class="participant-info" id="participant-info">
                    <span data-muid ="'.$user->user_id.'" class="participant-name">'.$user->firstName.' '.$user->lastName.'</span>
                    <span data-uid ="'.$user->user_id.'"class="cancel-participant">X</span>
                </div>';
            }
            
        }
        
    }

    if(isset($_POST['groupEditMembers']) && !empty($_POST['groupEditMembers'])){
        $groupid = h($_POST['groupEditMembers']);
        $userid = h($_POST['userid']); 
        $groupMembers = $loadFromGroup->groupMembers($groupid);

        if(!empty($groupMembers)){
            foreach($groupMembers as $member){
                if($member->user_id != $userid){
                    $user = $loadFromUser->userData($member->user_id);
                    echo '
                    <div class="participant-info" id="participant-info">
                        <span data-muid ="'.$user->user_id.'" class="participant-name">'.$user->firstName.' '.$user->lastName.'</span>
                        <span data-uid ="'.$user->user_id.'" data-gid ="'.$groupid.'" class="edit-remove-participant">X</span>
                    </div>';
                }
                
            }
            
        }
        
    }
    
}

?>