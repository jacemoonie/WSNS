<div class="notification-container">
    <!-- All request senders -->
        <div class="notification-content-container">
            <div class="noti-post">
            <div class="usersWrapper">
                <?php
                if($get_req_num > 0){
                    foreach($get_all_req_sender as $row){
                        $requestID = $row->sender;
                        $requestData = $loadFromUser->userData($requestID);
                        echo '
                        <div class="profile-user-container">
                            <div class="user-pic">
                                <img src="'.$requestData->profileImage.'" alt="'.$requestData->firstName.' '.$requestData->lastName.'" class="">
                            </div>
                            <div class="user-profile-details">
                            <span class="name">'.$requestData->firstName.' '.$requestData->lastName.'</span>
                            <span class="username">@'.$requestData->username.'</span>
                            <span class="username">Send you a friend request.</span>
                            </div>
                            <div class="user-friend-request-btn">
                            <span class="view-profile"><a class="Button" href="'.url_for($requestData->username).'">View profile</a></span>
                            <span class="accept-request"><a href="'.url_for(h($_SERVER['PHP_SELF']).'?action=accept_req&id='.$profileData->user_id.'').'" class="req_actionBtn Button acceptRequest">Accept</a></span>
                            </div>
                        </div>';
                    }
                }else{
                    echo 'Notification is empty.';
                }
                ?>
            </div>
        </div>
    </div>
</div>