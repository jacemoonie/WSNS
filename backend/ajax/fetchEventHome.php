<?php
require_once '../initialize.php';

if(is_post_request()){
    
  $eventData = $loadFromEvent->showEvent();
  if($eventData){
        echo $eventData;
    }
    

}

?>