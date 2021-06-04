<?php
require_once '../initialize.php';

if(is_post_request()){
    
    if(isset($_POST['annID']) && !empty($_POST['annID'])){
        
        $annID = h($_POST['annID']);
        $deleteAnnounce = $announce->deleteAnnouncement($annID);
        if($deleteAnnounce){
            // echo $deleteAnnounce;
            echo $announce->recentAnnouncement();
        }
    }
        
    
}

?>