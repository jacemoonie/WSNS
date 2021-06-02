<?php
require_once '../initialize.php';

if(is_post_request()){
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
}

?>