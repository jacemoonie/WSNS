<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['onlyStatusText']) && !empty($_POST['onlyStatusText'])){
        $userid = h($_POST['userid']);
        $privacy = h($_POST['privacy']);
        $allowed_tags='<div><li><h2><h3><ul><p><em><strong><br>';
        $statusText= strip_tags($_POST['onlyStatusText'],$allowed_tags);

        //insert post into DB
        $lastid = $loadFromUser->create("post",array("status"=>$statusText,"postBy"=>$userid,"postPrivacy"=>$privacy));
        if(!$lastid){
            echo "Failed";
        }
        //Display post
        echo  $loadFromPosts->allPosts($userid,10);
    }
}

?>