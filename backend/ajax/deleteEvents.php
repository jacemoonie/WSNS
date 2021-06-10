<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['eventID']) && !empty($_POST['eventID'])){
        
        $eventID = h($_POST['eventID']);

        $deleteEvent = $loadFromUser->delete("events",array("eventID"=>$eventID));

        if($deleteEvent){
            echo "Success";
        }else{
            echo "failed";
        }
         

    }
        
    
}

?>