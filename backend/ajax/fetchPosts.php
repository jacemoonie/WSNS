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

    if(isset($_POST['fetchPostsAdmin']) && !empty($_POST['fetchPostsAdmin'])){

        $limit = (int)trim($_POST['fetchPostsAdmin']);
        // echo $limit;
        $admin->recentPosts($limit);
    }

    if(isset($_POST['fetchPostsHome']) && !empty($_POST['fetchPostsHome'])){
        $userid = h($_POST['fetchPostsHome']);
        $loadFromPosts->allPosts($userid,10);
    }

    if(isset($_POST['fetchPostsHomeFriendOnly']) && !empty($_POST['fetchPostsHomeFriendOnly'])){
        $userid = h($_POST['fetchPostsHomeFriendOnly']);
        //Check friend
        $friendPost = $loadFromFriend->get_all_friends($userid, true);
        if($friendPost){
           var_dump($friendPost);
        }
        // $loadFromPosts->allPosts($userid,10);
    }
    
}

?>