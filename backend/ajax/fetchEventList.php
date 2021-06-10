<?php
require_once '../initialize.php';

if(is_post_request()){
    
    //FETCH RECENT MESSAGES
    if(isset($_POST['userIdLoadEventList']) && !empty($_POST['userIdLoadEventList'])){
        $userid = h($_POST['userIdLoadEventList']);
        $selectedEventID = h($_POST['loadEventid']);

        $allcreatedEvent = $loadFromEvent->listEvent($userid);

        if(!empty($allcreatedEvent)){
        // var_dump($allJoinedGroup);
            foreach($allcreatedEvent as $event){
                $activeclass = ($event->eventID == $selectedEventID) ? "activeClass" : "";
                echo ' 
                <li class="msg-user-name-wrap '.$activeclass.'"  data-eventid="'.$event->eventID.'">
                    <div class="msg-user-name-wrapper">
                        <div class="ms-user-photo">
                            <img src="'.url_for($event->eventImage).'" alt="'.$event->eventName.'" class="">
                        </div>
                        <div class="msg-user-name-text">
                            <div class="msg-user-new">
                                <div class="msg-user-name">
                                    <h3 class="">'.$event->eventName.'</h3>
                                    <span>ID : '.$event->eventID.'</span>
                                </div>
                                <div class="msg-user-text">
                                    <div class="msg-previ">
                                    <span>'.$event->eventDescription.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="msg-date-wrapper">
                                <div class="msg-date">'.$loadFromUser->timeAgo($event->eventCreatedOn).'</div>
                            </div>
                        </div>
                    </div>
                </li>';
            }
        }else{
            echo '<div class ="nogroup">No event created yet.</div>';
        }
         
        
    }

}
    
         
    


?>