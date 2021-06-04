<?php

class Announcement{

    private $pdo;
    private $user;

    public function __construct(){
        $this->pdo = Database::Instance();
        $this->user = new User;
    
    }

    public function annoucementData($ann_id){
        $stmt=$this->pdo->prepare("SELECT * FROM `announcement` WHERE `announcement_id`=:ann_id");
        $stmt->bindParam(":ann_id",$ann_id,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $announceData= $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $announceData;
        }else{
            return false;
        }
    }

    //CREATE ANNOUNCEMENT
    public function createAnnouncement($msg){
        $createAnnounce = $this->user->create("announcement",array("announcement_description" => $msg));
        if(!$createAnnounce){
            echo "Failed to create announcement";
            return false;
        }else{
            return true;
        }

    }
    
    //RECENT ANNOUNCEMENT
    public function recentAnnouncement(){
        $stmt = $this->pdo->prepare("SELECT * FROM `announcement` ORDER BY `announcementOn` DESC");
        $stmt->execute();
        $announcement = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($announcement as $ann){
            echo '
            <div class="adminProfile-user-container row"> 
                <div class="ann-post">
                    <div class="col-3 ann-logo">
                        <img src="'.url_for('frontend\assets\images\speaker-announce.svg').'" alt="" class="">
                    </div>
                    <div class="col ann-text">'.$ann->announcement_description.'</div>
                    <div class="col-1 ann-time"><span>'.$this->user->timeAgo($ann->announcementOn).'</span></div>
                    <div class="col edit-ann"><button id="edit-announce" data-auid="'.$ann->announcement_id.'" class="col" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal">Edit</button>
                    <button id="del-announce" data-auid="'.$ann->announcement_id.'" class="col">Delete</button></div>
                </div>
            </div>
            ';
        }
    }

    //DELETE ANNOUNCEMENT
    public function deleteAnnouncement($ann_id){
        $stmt = $this->pdo->prepare("DELETE FROM `announcement` WHERE `announcement_id` =:ann_id");
        $stmt->bindParam(":ann_id",$ann_id,PDO::PARAM_INT);
        if(!$stmt->execute()){
            echo "Failed to delete";
            return false;
        }else{
            return true;
        }
        
    }

    //UPDATE ANNOUNCEMENT
    public function updateAnnouncement($ann_id,$msg){
        $sql = "UPDATE `announcement` SET `announcement_description`=:msg WHERE announcement_id=:ann_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":ann_id",$ann_id,PDO::PARAM_INT);
        $stmt->bindParam(":msg",$msg,PDO::PARAM_STR);
        if(!$stmt->execute()) {
            throw new ErrorException('Could not execute query');
        }else{
            return true;
        }
    }

    //SHOW ANNOUNCEMENT AT USERS WALL
    public function showAnnouncement(){
        $stmt = $this->pdo->prepare("SELECT * FROM `announcement` ORDER BY `announcementOn` DESC");
        $stmt->execute();
        $announcement = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($announcement as $ann){
            echo '
            <div class="adminProfile-user-container row"> 
                <div class="ann-post">
                    <div class="col ann-text"><span style>'.$this->user->timeAgo($ann->announcementOn).'</span> : '.$ann->announcement_description.'</div>
                </div>
            </div>
            ';
        }
    }

    public function postAnnouncement($user_id,$num){
        $stmt = $this->pdo->prepare("SELECT * FROM `post` , `users` WHERE `postBy`=`user_id` AND `user_id` =:userId ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){
            // $postControls = new PostsControls;
            // $controls = $postControls->createControls($post->postID,$post->postBy,$user_id);
            echo'<article role="article" data-focusable="true" tabIndex="0" class="post">
            <div class="feed-post-container row">
                           <div class="post-content-container">
                               <div class="user-pic">
                                   <img src="'.url_for($post->profileImage).'" alt="" class="">
                               </div>
                               <div class="user-profile-details">
                                   <span class="name"><a href="'.url_for($post->username).'">'.$post->firstName.' '.$post->lastName.'</a></span>
                                   <span class="username">@'.$post->username.'</span>
                                   <span class="date">'.$this->user->timeAgo($post->postedOn).'</span>
                               </div>
                               <div class="post-edit-btn">
                               '.(($post->postBy===$user_id) ? '
                               <div class="d-wrapper-container">
                               <div class="d-wrapper">
                                   <div class="d-content" id="del-content">
                                       <div class="d-image">
                                           <button type="button" data-post="'.$post->postID.'" data-postBy="'.$post->postBy.'" data-user="'.$user_id.'" id="delete-post-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messagePromptModal">
                                            <svg viewBox="0 0 24 24" class="del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>
                                         </button>
                                        </div>
                                   </div>
                               </div>
                           </div>' : '').'
                               </div>
                           </div>
                           <div class="user-post row">
                               <article>'.$post->status.'</article>
                           </div>
                            <div class="posts-btn row">
                                <div class="comment-btn col">
                                <img src="'.url_for("frontend\assets\images\comment.svg").'" alt="" class="">
                                    <div class="comment-counter"><span class="">0</span></div>
                                </div>
                                <div class="like-btn col">
                                    <img src="'.url_for("frontend\assets\images\like.svg").'" alt="" class="">
                                    <div class="like-counter"><span class="">0</span></div>
                                </div>
                            </div>
                       </div>
            </article> ';
        }
        
    }
    
    public function postsProfile($user_id,$profileId,$num){
        $stmt = $this->pdo->prepare("SELECT * FROM `post` , `users` WHERE `postBy`=`user_id` AND `user_id` =:userId ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":userId",$profileId,PDO::PARAM_INT);
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){
            // $postControls = new PostsControls;
            // $controls = $postControls->createControls($post->postID,$post->postBy,$user_id);
            echo'<article role="article" data-focusable="true" tabIndex="0" class="post">
            <div class="feed-post-container row">
                           <div class="post-content-container">
                               <div class="user-pic">
                                   <img src="'.url_for($post->profileImage).'" alt="" class="">
                               </div>
                               <div class="user-profile-details">
                                   <span class="name"><a href="'.url_for($post->username).'">'.$post->firstName.' '.$post->lastName.'</a></span>
                                   <span class="username">@'.$post->username.'</span>
                                   <span class="date">'.$this->user->timeAgo($post->postedOn).'</span>
                               </div>
                               <div class="post-edit-btn">
                               '.(($post->postBy===$user_id) ? '
                               <div class="d-wrapper-container">
                               <div class="d-wrapper">
                                   <div class="d-content" id="del-content">
                                       <div class="d-image">
                                           <button type="button" data-post="'.$post->postID.'" data-postBy="'.$post->postBy.'" data-user="'.$user_id.'" id="delete-post-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messagePromptModal">
                                            <svg viewBox="0 0 24 24" class="del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>
                                         </button>
                                        </div>
                                   </div>
                               </div>
                           </div>' : '').'
                               </div>
                           </div>
                           <div class="user-post row">
                               <article>'.$post->status.'</article>
                           </div>
                            <div class="posts-btn row">
                                <div class="comment-btn col">
                                <img src="'.url_for("frontend\assets\images\comment.svg").'" alt="" class="">
                                    <div class="comment-counter"><span class="">0</span></div>
                                </div>
                                <div class="like-btn col">
                                    <img src="'.url_for("frontend\assets\images\like.svg").'" alt="" class="">
                                    <div class="like-counter"><span class="">0</span></div>
                                </div>
                            </div>
                       </div>
            </article> ';
        }
        
    }
    public function allPosts($user_id,$num){
        $stmt = $this->pdo->prepare("SELECT * FROM `post` , `users` WHERE `postBy`=`user_id` ORDER BY postedOn DESC LIMIT :num");
        $stmt->bindParam(":num",$num,PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($posts as $post){
            // $postControls = new PostsControls;
            // $controls = $postControls->createControls($post->postID,$post->postBy,$user_id);
            echo'<article role="article" data-focusable="true" tabIndex="0" class="post">
            <div class="feed-post-container row">
                           <div class="post-content-container">
                               <div class="user-pic">
                                   <img src="'.url_for($post->profileImage).'" alt="" class="">
                               </div>
                               <div class="user-profile-details">
                                   <span class="name"><a href="'.url_for($post->username).'">'.$post->firstName.' '.$post->lastName.'</a></span>
                                   <span class="username">@'.$post->username.'</span>
                                   <span class="date">'.$this->user->timeAgo($post->postedOn).'</span>
                               </div>
                               <div class="post-edit-btn">
                               '.(($post->postBy===$user_id) ? '<div class="d-wrapper-container">
                               <div class="d-wrapper">
                                   <div class="d-content" id="del-content">
                                       <div class="d-image">
                                           <button type="button" data-post="'.$post->postID.'" data-postBy="'.$post->postBy.'" data-user="'.$user_id.'" id="delete-post-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messagePromptModal">
                                            <svg viewBox="0 0 24 24" class="del-icon"><g><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path><path d="M10 17.75c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75zm4 0c.414 0 .75-.336.75-.75v-7c0-.414-.336-.75-.75-.75s-.75.336-.75.75v7c0 .414.336.75.75.75z"></path></g></svg>
                                         </button>
                                        </div>
                                   </div>
                               </div>
                           </div>' : '').'
                               </div>
                           </div>
                           <div class="user-post row">
                               <article>'.$post->status.'</article>
                           </div>
                            <div class="posts-btn row">
                                <div class="comment-btn col">
                                <img src="'.url_for("frontend\assets\images\comment.svg").'" alt="" class="">
                                    <div class="comment-counter"><span class="">0</span></div>
                                </div>
                                <div class="like-btn col">
                                    <img src="'.url_for("frontend\assets\images\like.svg").'" alt="" class="">
                                    <div class="like-counter"><span class="">0</span></div>
                                </div>
                            </div>
                       </div>
            </article> ';
        }
        
    }
    public function getTrendByHash($hashtag){
        $stmt = $this->pdo->prepare("SELECT DISTINCT `hashtag` FROM `trends` WHERE `hashtag` LIKE :hashtag LIMIT 5");
        $stmt->bindValue(":hashtag",$hashtag.'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMention($mention){
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE `username` LIKE :mention OR `firstName` LIKE :mention OR `lastName` LIKE :mention LIMIT 5");
        $stmt->bindValue(":mention",$mention.'%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function addTrend($hashtag,$postID,$user_id){
        preg_match_all("/#+([a-zA-Z0-9_]+)/i",$hashtag,$matches);
        if($matches){
            $result = array_values($matches[1]);
        }

        $sql = "INSERT INTO `trends` (`hashtag`,`postID`,`user_id`,`createdOn`) VALUES (:hashtag,:postID,:userId,:dateOn)";

        foreach($result as $trend){
            if($stmt = $this->pdo->prepare($sql)){
                $stmt->execute(array(':hashtag'=>$trend,':postID'=>$postID,':userId'=>$user_id,':dateOn'=>date('Y-m-d H:i:s')));
            }
        }
    }

    public function getLikes($postId){
        $stmt = $this->pdo->prepare("SELECT count(*) as `count` FROM `likes` WHERE `likeOn` =:postId");
        $stmt ->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt ->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data["count"] > 0 ){
            return $data["count"];
        } 
    }

    public function likes($user_id,$postId){
       if($this->wasLikedBy($user_id,$postId)){
           //user has already likes
           $this->user->delete("likes",array("likeBy" => $user_id, "likeOn" =>$postId));
           $result = array("likes"=>-1);
           return json_encode($result);
       }else{
           //user has not liked.
        //    echo "Not liked";
            $this->user->create("likes",array("likeBy" => $user_id, "likeOn" =>$postId));
            $result = array("likes"=>1);
            return json_encode($result);
       }
    }

    public function wasLikedBy($user_id,$postId){
        $stmt = $this->pdo->prepare("SELECT * FROM `likes` WHERE `likeBy` =:userId AND `likeOn` =:postId");
        $stmt ->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt ->bindParam(":postId",$postId,PDO::PARAM_INT);
        $stmt ->execute();
        return $stmt ->rowCount() > 0;
    }

    public function PostCounts($profileId){
        $stmt = $this->pdo->prepare("SELECT count('postID') as `postCount` FROM `post` WHERE `postBy` =:profileId");
        $stmt->bindParam(":profileId",$profileId,PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data["postCount"] > 0){
            return $data["postCount"];
        }
    }

    public function createTab($name,$href,$isSelected){
        $className = $isSelected ? "tab active":"tab";
        return "<a href='$href' class='$className'>
            <span>$name</span>
            </a>";
    }
}



?>