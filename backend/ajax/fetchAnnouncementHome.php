<?php
require_once '../initialize.php';

if(is_post_request()){
    
  $AnnounceData = $announce->showAnnouncement();
  if($AnnounceData){
        echo $AnnounceData;
    }
    
        
    
}

?>