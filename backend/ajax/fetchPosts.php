<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])){
        $userid = h($_POST['userId']);
        $limit = (int)trim($_POST['fetchPosts']);
        // echo $limit;
        $loadFromPosts->allPosts($userid,$limit);
    }
    
    if(isset($_POST['fetchPostsProfile']) && !empty($_POST['fetchPostsProfile'])){
        $userid = h($_POST['userId']);
        $profileId = h($_POST['profileId']);
        $limit = (int)trim($_POST['fetchPostsProfile']);
        // echo $limit;
        $loadFromPosts->postsProfile($userid,$profileId,$limit);
    }
}

?>