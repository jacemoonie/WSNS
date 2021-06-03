<?php
require_once '../initialize.php';

if(is_post_request()){
    //FETCH RECENT MESSAGES
    if(isset($_POST['loadUserid']) && !empty($_POST['loadUserid'])){
        $userid = h($_POST['loadUserid']);
        $otherid = h($_POST['otheruserid']);
        // echo $limit;
        $allusermsg = $loadFromMessage->recentMessage($userid);
        foreach($allusermsg as $user){
            $activeclass = ($user->user_id == $otherid) ? "activeClass" : "";
            echo ' 
            <li class="msg-user-name-wrap '.$activeclass.'"  data-profileId="'.$user->user_id.'">
                <div class="msg-user-name-wrapper">
                    <div class="ms-user-photo">
                        <img src="'.url_for($user->profileImage).'" alt="'.$user->firstName.''.$user->lastName.'" class="">
                    </div>
                    <div class="msg-user-name-text">
                        <div class="msg-user-new">
                            <div class="msg-user-name">
                                <h3 class="">'.$user->firstName.''.$user->lastName.'</h3>
                                <span>@'.$user->username.'</span>
                            </div>
                            <div class="msg-user-text">
                                <div class="msg-previ">
                                '.$user->message.'
                                </div>
                            </div>
                        </div>
                        <div class="msg-date-wrapper">
                            <div class="msg-date">'.$loadFromUser->timeAgo($user->messageOn).'</div>
                        </div>
                    </div>
                </div>
            </li>';
        }
    }

    //FETCH CHAT MESSAGES
    if(isset($_POST['otherpersonid']) && !empty($_POST['otherpersonid'])){
        $userid = h($_POST['userId']);
        $otherid = h($_POST['otherpersonid']);
    
        $messageData = $loadFromMessage->messageData($userid,$otherid);
        if(!empty($messageData)){
            echo '<div class="past-data-count" data-count="'.count($messageData).'"></div>';
            foreach($messageData as $message){
                if($message->messageFrom == $userid){
                    echo '
                    <div class="right-sender-msg">
                        <div class="right-sender-text-time">
                            <div class="right-sender-text-wrapper">
                                <div class="s-text">
                                    <div class="s-msg-text">
                                       '.$message->message.'
                                    </div>
                                </div>
                            </div>
                            <div class="sender-time">'.$loadFromUser->timeAgo($message->message).'</div>
                        </div>
                    </div>';
                }else{
                    echo '
                    <div class="left-receiver-msg">
                        <a href="'.url_for($message->username).'" class="receive-msg">
                            <img src="'.url_for($message->profileImage).'" alt="'.$message->firstName.' '.$message->lastName.'" class="">
                        </a>
                        <div class="left-receive-text-time">
                            <div class="left-receiver-text-wrapper">
                                    <div class="r-text">
                                        <div class="r-msg-text">
                                        '.$message->message.'
                                        </div>
                                    </div>
                                </div>
                                <div class="sender-time">'.$loadFromUser->timeAgo($message->message).'</div>
                            </div>  
                        </div>
                    </div>';
                }
            }
        }
    }
}
    
         
    


?>