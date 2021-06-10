<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['fetchPosts']) && !empty($_POST['fetchPosts'])){
        $userid = h($_POST['userId']);
        $limit = (int)trim($_POST['fetchPosts']);
        // echo $limit;
        $loadFromPosts->allPosts($userid,$limit);
    }
    if(isset($_POST['fetchPostsFriend']) && !empty($_POST['fetchPostsFriend'])){
        $userid = h($_POST['userId']);
        $limit = (int)trim($_POST['fetchPostsFriend']);
        // echo $limit;
        $loadFromPosts->allFriendPosts($userid,$limit);
    }
    
    if(isset($_POST['fetchPostsProfile']) && !empty($_POST['fetchPostsProfile'])){
        $userid = h($_POST['userId']);
        $profileId = h($_POST['profileId']);
        $limit = (int)trim($_POST['fetchPostsProfile']);
        // echo $limit;
        $loadFromPosts->postsProfile($userid,$profileId,$limit);
    }

    if(isset($_POST['fetchPostsAdmin']) && !empty($_POST['fetchPostsAdmin'])){

        $limit = (int)trim($_POST['fetchPostsAdmin']);
        // echo $limit;
        $admin->recentPosts($limit);
    }

    if(isset($_POST['fetchPostAll']) && !empty($_POST['fetchPostAll'])){
        $userid = h($_POST['fetchPostAll']);
        $loadFromPosts->allPosts($userid,10);
    }

    if(isset($_POST['fetchPostFriend']) && !empty($_POST['fetchPostFriend'])){
        $userid = h($_POST['fetchPostFriend']);
        $loadFromPosts->allFriendPosts($userid,50);
    }

    
    
}

?>