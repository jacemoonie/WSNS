<?php
require_once '../initialize.php';

if(is_post_request()){
    
    if(isset($_POST['annID']) && !empty($_POST['annID'])){
        
        $annID = h($_POST['annID']);
        $AnnounceData = $announce->annoucementData($annID);
        if($AnnounceData){
            
            echo $AnnounceData->announcement_description;
        }
    }
        
    
}

?>