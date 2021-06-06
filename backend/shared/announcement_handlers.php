<?php

if(is_post_request()){
    if(isset($_POST['description']) && !empty(isset($_POST['description']))){
       $msg = h($_POST['description']);
       $createAnnouncement = $announce->createAnnouncement($msg);
       if(!$createAnnouncement){
           echo "FAILED TO CREATE ANNOUNCEMENT";
       }
    }

    if(isset($_POST['ann_id']) && !empty(isset($_POST['ann_id']))){
        $ann_id = h($_POST['ann_id']);
        $msg = h($_POST['edit-description']);
        $updateAnnouncement = $announce->updateAnnouncement($ann_id,$msg);
        if(!$updateAnnouncement){
            echo "FAILED TO UPDATE ANNOUNCEMENT";
        }
     }
}

?>