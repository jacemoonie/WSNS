<?php
require_once '../initialize.php';

if(is_post_request()){
    if(isset($_POST['postId']) && !empty($_POST['postId'])){
        
        $postID = h($_POST['postId']);
        $postBy = h($_POST['postBy']);
        $userId = h($_POST['userId']);

        if($userId == $postBy){
            $loadFromUser->delete("post",["postBy"=>$userId,"postID"=>$postID]);
        }   

        // echo $loadFromPosts->posts($userId,10);
    }
        
    
}

?>