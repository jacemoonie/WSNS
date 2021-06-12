<?php $pageTitle="Friend | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php';
 
$user_id = $_SESSION['userLoggedIn'];
$status = $verify->getVerifyStatus("status",$user_id);

//check if user is logged in
if(isset($_SESSION['userLoggedIn']) && $status->status === "1"){
    $user_id = $_SESSION['userLoggedIn'];
    
}else if(Login::isLoggedIn()){
    $user_id = Login::isLoggedIn();
}else{
    redirect_to(url_for("index"));
}

include 'backend\shared\friend_handlers.php';

$user = $loadFromUser->userData($user_id);
 // TOTAL REQUESTS
$get_req_num = $loadFromFriend->request_notification($_SESSION['userLoggedIn'], false);
// TOTLA FRIENDS
$get_frnd_num = $loadFromFriend->get_all_friends($_SESSION['userLoggedIn'], false);
// GET MY($_SESSION['user_id']) ALL FRIENDS
$get_all_friends = $loadFromFriend->get_all_friends($_SESSION['userLoggedIn'], true);

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php' ?>
        <div class="mid-section col-sm-6"> 
           <div class="message-section container">
               <div class="message-header container">
                   <h2 class="">Friend</h2>
                   <a href="<?php echo url_for("friend/add-friend") ?>" class="n-friend " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#addFriendModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
                   <?php include 'backend\modal\friendModal.php'; ?>
                </div>
                <div class="messages-list">
                    <h3>All friends</h3>
                    <div class="usersWrapper">
                        <?php
                        if($get_frnd_num > 0){
                            foreach($get_all_friends as $row){
                                $requestID = $row->user_id;
                                $requestData = $loadFromUser->userData($requestID);
                                echo '
                                <div class="profile-user-container">
                                    <div class="user-pic">
                                        <img src="'.$requestData->profileImage.'" alt="'.$requestData->firstName.' '.$requestData->lastName.'" class="">
                                    </div>
                                    <div class="user-profile-details">
                                    <span class="name">'.$requestData->firstName.' '.$requestData->lastName.'</span>
                                    <span class="username">@'.$requestData->username.'</span>
                                    </div>
                                    <div class="user-friend-request-btn">
                                    <span class="view-profile"><a class="Button" href="'.url_for($requestData->username).'">View profile</a></span>
                                    <span class="view-profile"><a class="Button" href="messages/'.$requestData->user_id.'">Message</a></span>
                                    </div>
                                </div>';
                            }
                        }
                        else{
                            echo '<h4>You have no friends!</h4>';
                        }
                        ?>
                    </div>
                </div>
           </div>
        </div>

        <?php include 'backend\shared\right-section.php' ?>
    </div>
</div>
<?php include 'backend\loadJsFiles.php'; ?>
<script src="<?php echo url_for('frontend\assets\js\friend.js'); ?>"></script>
