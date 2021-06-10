<?php
require_once '../initialize.php';

if(is_post_request()){
    
    //FETCH RECENT MESSAGES
    if(isset($_POST['userIdLoadGroupList']) && !empty($_POST['userIdLoadGroupList'])){
        $userid = h($_POST['userIdLoadGroupList']);
        $selectedGroupID = h($_POST['LoadgroupId']);

        $allJoinedGroup = $loadFromGroup->listGroup($userid);

        if(!empty($allJoinedGroup)){
        // var_dump($allJoinedGroup);
            foreach($allJoinedGroup as $group){
                $groupData = $loadFromGroup->groupDataByID($group->group_id);
                $allGroupMsg = $loadFromGroupMessage->allMessageInGroup($group->group_id);
                if($allGroupMsg){
                    $lastMessage = end($allGroupMsg);
                    $message = $lastMessage->groupMessage;
                    $messageOn = $lastMessage->groupMessageOn;
                    $messageFrom = $lastMessage->groupMsgFrom;
                    $userData = $loadFromUser->userData($messageFrom);
                    $messageFromName = $userData->firstName.' '.$userData->lastName;
                }else{
                    $message = "Nobody start talking yet";
                    $messageOn = $groupData->groupCreatedAt;
                    $messageFrom = "";
                    $messageFromName = "";
                }
                $activeclass = ($groupData->groupID == $selectedGroupID) ? "activeClass" : "";
                echo ' 
                <li class="msg-user-name-wrap '.$activeclass.'"  data-groupID="'.$groupData->groupID.'">
                    <div class="msg-user-name-wrapper">
                        <div class="ms-user-photo">
                            <img src="'.url_for($groupData->groupImage).'" alt="'.$groupData->groupName.'" class="">
                        </div>
                        <div class="msg-user-name-text">
                            <div class="msg-user-new">
                                <div class="msg-user-name">
                                    <h3 class="">'.$groupData->groupName.'</h3>
                                    <span>ID : '.$groupData->groupID.'</span>
                                </div>
                                <div class="msg-user-text">
                                    <div class="msg-previ">
                                    <span>'.$messageFromName.' : '.$message.'
                                    </div>
                                </div>
                            </div>
                            <div class="msg-date-wrapper">
                                <div class="msg-date">'.$loadFromUser->timeAgo($messageOn).'</div>
                            </div>
                        </div>
                    </div>
                </li>';
            }
        }else{
            echo '<div class ="nogroup">No group joined or created yet.</div>';
        }
         
        
    }

    // FETCH CHAT MESSAGES
    if(isset($_POST['groupMsgId']) && !empty($_POST['groupMsgId'])){
        $userid = h($_POST['userId']);
        $groupId = h($_POST['groupMsgId']);
    
        $messageData = $loadFromGroupMessage->allMessageInGroup($groupId);
        // var_dump($messageData );
        if(!empty($messageData)){
            echo '<div class="past-data-count" data-count="'.count($messageData).'"></div>';
            foreach($messageData as $message){

                if($message->groupMsgFrom != $userid){
                    $userData = $loadFromUser->userData($message->groupMsgFrom);
                }
                if($message->groupMsgFrom == $userid){
                    echo '
                    <div class="right-sender-msg">
                        <div class="right-sender-text-time">
                            <div class="right-sender-text-wrapper">
                                <div class="s-text">
                                    <div class="s-msg-text">
                                       '.$message->groupMessage.'
                                    </div>
                                </div>
                            </div>
                            <div class="sender-time">'.$loadFromUser->timeAgo($message->groupMessageOn).'</div>
                        </div>
                    </div>';
                }else{
                    echo '
                    <div class="left-receiver-msg">
                        <a href="'.h(url_for($userData->username)).'" class="receive-msg">
                            <img src="'.url_for($userData->profileImage).'" alt="'.$userData->firstName.' '.$userData->lastName.'" class="">
                        </a>
                        <div class="left-receive-text-time">
                            <div class="left-receiver-text-wrapper">
                                    <div class="r-text">
                                        <span class="r-msg-name">
                                        '.$userData->firstName.' '.$userData->lastName.'
                                        </span>
                                        <div class="r-msg-text">
                                        '.$message->groupMessage.'
                                        </div>
                                    </div>
                                </div>
                                <div class="sender-time">'.$loadFromUser->timeAgo($message->groupMessageOn).'</div>
                            </div>  
                        </div>
                    </div>';
                }
            }
        }
    }
}
    
         
    


?>