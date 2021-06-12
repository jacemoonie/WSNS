<?php
class Notification{
    
    protected $pdo;
    protected $user;
    protected $group;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user= new User;
        $this->group= new Group;
        
    }
    public function notiCounter($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `notification` WHERE `notificationFor` =:userId AND `status` = '0'");
        $stmt->bindValue(':userId',$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $notiCount = $stmt->rowCount();
        if(!$notiCount == 0){
            return $notiCount;
        }else{
            return $notiCount=0;
        }
    }

    public function getNotidById($notiFrom,$notiFor,$type){
        $stmt = $this->pdo->prepare("SELECT `ID` FROM `notification` WHERE `notificationFor` =:notiFor AND `notificationFrom` =:notiFrom AND `type` =:notiType AND `status` = '0'");
        $stmt->bindValue(':notiFor',$notiFor, PDO::PARAM_INT);
        $stmt->bindValue(':notiFrom',$notiFrom, PDO::PARAM_INT);
        $stmt->bindValue(':notiType',$type, PDO::PARAM_STR);
        $stmt->execute();
        $notiCount = $stmt->rowCount();
        if(!$notiCount == 0){
            return $stmt->fetch(PDO::FETCH_OBJ);
        }else{
            return false;
        }
    }

    //UPDATE EVENT
    public function update($tableName,$notiID, array $fields)
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
        $sql = "UPDATE {$tableName} SET {$columns} WHERE `ID`={$notiID} ";
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
            return false;
        }else{
            return true;
        }
    
    }

    public function showNotification($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `notification`");
        $stmt->execute();
        $notiData = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($notiData as $noti){
            //CHECK NOTI STATUS
            if($noti->status == 0 && $noti->notificationFor==$user_id){
                $requestData = $this->user->userData($noti->notificationFrom);
                //CHECK WHICH TYPE
                if($noti->type=="friend"){ 
                    echo '
                    <li class="profile-user-container">
                        <div class="user-pic">
                            <img src="'.$requestData->profileImage.'" alt="'.$requestData->firstName.' '.$requestData->lastName.'" class="">
                        </div>
                        <div class="user-profile-details">
                        <span class="name"><a href="'.url_for($requestData->firstName.''.$requestData->lastName).'">'.$requestData->firstName.' '.$requestData->lastName.'</a></span>
                        <span class="username">@'.$requestData->username.'</span>
                        <span class="username">Send you a friend request.</span>
                        </div>
                        <div class="user-friend-request-btn">
                        <span class="accept-request"><a href="'.h($_SERVER['PHP_SELF']).'?action=accept_req&id='.$requestData->user_id.'&notid='.$noti->ID.'" class="req_actionBtn Button acceptRequest">Accept</a></span>
                        </div>
                    </li>';
                }else if($noti->type == "acceptFriend"){
                    echo '
                    <li class="profile-user-container">
                        <div class="user-pic">
                            <img src="'.$requestData->profileImage.'" alt="'.$requestData->firstName.' '.$requestData->lastName.'" class="">
                        </div>
                        <div class="user-profile-details">
                        <span class="name"><a href="'.url_for($requestData->firstName.''.$requestData->lastName).'">'.$requestData->firstName.' '.$requestData->lastName.'</a></span>
                        <span class="username">@'.$requestData->username.'</span>
                        <span class="username">Has accepted your friend request.</span>
                        </div>
                        <div class="user-friend-request-btn">
                        <span class="view-profile"><a class="Button" href="'.h($_SERVER['PHP_SELF']).'?type='.$noti->type.'&id='.$requestData->user_id.'&notid='.$noti->ID.'">Message</a></span>
                        </div>
                    </li>';
                }else if($noti->type == "message"){
                    echo '
                    <li class="profile-user-container">
                        <div class="user-pic">
                            <img src="'.$requestData->profileImage.'" alt="'.$requestData->firstName.' '.$requestData->lastName.'" class="">
                        </div>
                        <div class="user-profile-details">
                        <span class="name"><a href="'.url_for($requestData->firstName.''.$requestData->lastName).'">'.$requestData->firstName.' '.$requestData->lastName.'</a></span>
                        <span class="username">@'.$requestData->username.'</span>
                        <span class="username">send you a new message.</span>
                        </div>
                        <div class="user-friend-request-btn">
                        <span class="view-profile"><a class="Button" href="'.h($_SERVER['PHP_SELF']).'?type='.$noti->type.'&id='.$requestData->user_id.'&notid='.$noti->ID.'">View message</a></span>
                        </div>
                    </li>';
                }else if($noti->type == "groupMessage"){
                    if(!empty($noti->target)){
                        $groupData = $this->group->groupDataByID($noti->target);
                        echo '
                        <li class="profile-user-container">
                            <div class="user-pic">
                                <img src="'.$groupData->groupImage.'" alt="'.$groupData->groupName.'" class="">
                            </div>
                            <div class="user-profile-details">
                            <span class="name"><a href="'.url_for('group/'.$groupData->groupID).'">'.$groupData->groupName.'</a></span>
                            <span class="username">@'.$requestData->username.' send a new message.</span>
                            </div>
                            <div class="user-friend-request-btn">
                            <span class="view-profile"><a class="Button" href="'.h($_SERVER['PHP_SELF']).'?type='.$noti->type.'&id='.$groupData->groupID.'&notid='.$noti->ID.'">View message</a></span>
                            </div>
                        </li>';
                    }
                }else{
                    echo '<h5>You have no notification at the moment.</h5>';
                }
            }
        }
    }
}