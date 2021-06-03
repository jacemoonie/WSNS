<?php
require_once '../initialize.php';

if(is_post_request()){
    //FETCH RECENT MESSAGES
    if(isset($_POST['userIdForAjax']) && !empty($_POST['userIdForAjax'])){
        $userid = h($_POST['userIdForAjax']);
        $otherid = h($_POST['otherIdForAjax']);
        $msg = h($_POST['msg']);
        // echo $msg;

        //STORE MESSAGE IN DB
        $loadFromUser->create("messages",array("message"=>$msg,"messageFrom"=>$userid,"messageTo"=>$otherid,"messageOn"=>date('Y-m-d H:i:s')));
    
        //DISPLAY MESSAGE
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
                            <div class="sender-time">'.$loadFromUser->timeAgo($message->messageOn).'</div>
                        </div>
                    </div>';
                }else{
                    echo '
                    <div class="left-receiver-msg">
                        <a href="'.h(url_for($message->username)).'" class="receive-msg">
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
                                <div class="sender-time">'.$loadFromUser->timeAgo($message->messageOn).'</div>
                            </div>  
                        </div>
                    </div>';
                }
            }
        }
    }

    if(isset($_POST['showMsg']) && !empty($_POST['showMsg'])){
        $userid = h($_POST['yourId']);
        $otherid = h($_POST['showMsg']);

        //DISPLAY MESSAGE
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
                            <div class="sender-time">'.$loadFromUser->timeAgo($message->messageOn).'</div>
                        </div>
                    </div>';
                }else{
                    echo '
                    <div class="left-receiver-msg">
                        <a href="'.h(url_for($message->username)).'" class="receive-msg">
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
                                <div class="sender-time">'.$loadFromUser->timeAgo($message->messageOn).'</div>
                            </div>  
                        </div>
                    </div>';
                }
            }
        }
    }
}
    

?>