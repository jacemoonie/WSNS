<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['onlyStatusText']) && !empty($_POST['onlyStatusText'])){
        $userid = h($_POST['userid']);
        $allowed_tags='<div><li><h2><h3><ul><p><em><strong><br>';
        $statusText= strip_tags($_POST['onlyStatusText'],$allowed_tags);

        //insert post into DB
        $lastid = $loadFromUser->create("post",array("status"=>$statusText,"postBy"=>$userid));

        //Display post
        echo $loadFromPosts->posts($userid,10);
    }
}

?>