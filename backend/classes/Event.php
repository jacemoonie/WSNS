<?php

class Event{

    private $pdo;
    private $user;

    public function __construct(){
        $this->pdo = Database::Instance();
        $this->user = new User;
    
    }

    public function eventData($event_id){
        $stmt=$this->pdo->prepare("SELECT * FROM `events` WHERE `eventID`=:event_id");
        $stmt->bindParam(":event_id",$event_id,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $eventData= $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $eventData;
        }else{
            return false;
        }
    }

    public function listEvent($userid){
        $stmt=$this->pdo->prepare("SELECT * FROM `events` WHERE `eventBy`=:userid");
        $stmt->bindParam(":userid",$userid,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $eventData= $stmt->fetchAll(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $eventData;
        }else{
            return false;
        }
    }

    //CREATE ANNOUNCEMENT
    public function createEvent($eventName,$eventDescription,$eventDate,$eventCreatedOn,$eventBy,$eventImage){
        $eventImage = "frontend\assets\images\default_profile.png";
        $createAnnounce = $this->user->create("events",array("eventBy"=>$eventBy,"eventName"=>$eventName,"eventDescription"=>$eventDescription,"eventDate"=>$eventDate,"eventImage"=>$eventImage));
        if(!$createAnnounce){
            echo "Failed to create event";
            return false;
        }else{
            return true;
        }

    }
    

    //UPDATE EVENT
    public function update($tableName,$eventID, array $fields)
    {

        /*
        * Check for input errors.
        */
        if(empty($fields)) {
            throw new InvalidArgumentException('Cannot insert an empty array.');
        }
        if(!is_string($tableName)) {
            throw new InvalidArgumentException('Table name must be a string.');
        }


        $columns="";
        $i=1;
        foreach($fields as $name => &$value){
            $columns .= "{$name} = :{$name}";
            if($i < count($fields)){
                $columns .= " , ";
            }
            $i++;
        }
        // $sql = 'SELECT * FROM verification WHERE code = :code';
        $sql = "UPDATE {$tableName} SET {$columns} WHERE `eventID`={$eventID} ";
        // $sql = "SELECT {$columnName} FROM {$tableName} WHERE {$columns}";


        // var_dump($sql);

        // Prepare new statement
        $stmt = $this->pdo->prepare($sql);

        /*
        * Bind parameters into the query.
        *
        * We need to pass the value by reference as the PDO::bindParam method uses
        * that same reference.
        */
        foreach($fields as $key => &$value) {

            // Prefix the placeholder with the identifier
            $key = ':' . $key;

            // Bind the parameter.
            $stmt->bindValue($key, $value);

        }

        /*
        * Check if the query was executed. This does not check if any data was actually
        * inserted as MySQL can be set to discard errors silently.
        */
        if(!$stmt->execute()) {
            throw new ErrorException('Could not execute query');
        }else{
            return true;
        }
    
    }

    //SHOW ANNOUNCEMENT AT USERS WALL
    public function showEvent(){
        $stmt = $this->pdo->prepare("SELECT * FROM `events` ORDER BY `eventCreatedOn` DESC");
        $stmt->execute();
        $eventData = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($eventData as $event){
            echo '
                <li class="msg-user-name-wrap"  data-eventid="'.$event->eventID.'">
                    <div class="msg-user-name-wrapper">
                        <div class="msg-user-name-text">
                            <div class="msg-user-new">
                                <div class="msg-user-name">
                                    <h3 class="">'.$event->eventName.'</h3>
                                    <span>ID : '.$event->eventID.'</span>
                                </div>
                                <div class="msg-user-text">
                                    <div class="msg-previ">
                                    <span style="font-size:1.3rem;" >'.$event->eventDescription.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="msg-date-wrapper">
                                <div class="msg-date">'.$this->user->timeAgo($event->eventCreatedOn).'</div>
                            </div>
                        </div>
                    </div>
                </li>
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
    
    
  
}



?>