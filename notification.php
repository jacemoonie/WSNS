<?php $pageTitle="Notification | WeLink";
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

if(is_get_request()){

    if(isset($_GET['username']) && !empty($_GET['username'])){
      $username = FormSanitizer::formSanitizerString($_GET['username']);
      $profileID = $loadFromUser->userIdByUsername($username);
      if(!$profileID){
          redirect_to(url_for("home")); 
      }else{
          $profileId = $profileID;
      }
    }else{
        $profileId = $user_id;
    }
}

$user = $loadFromUser->userData($user_id);

//Notification for friend request
// TOTAL REQUESTS
$get_req_num = $loadFromFriend->request_notification($_SESSION['userLoggedIn'], false);
// TOTAL FRIENDS
$get_frnd_num = $loadFromFriend->get_all_friends($_SESSION['userLoggedIn'], false);
$get_all_req_sender = $loadFromFriend->request_notification($_SESSION['userLoggedIn'], true);

?>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php' ?>
        <div class="mid-section col-sm-6"> 
           <div class="home-section container">
               <div class="noti-header row">
                   <h2 class="">Notification</h2>
                   <img src="frontend\assets\images\settings.png" alt="" class="notification-setting-icon">
               </div>
               <div class="noti-feed-container row">
                   <div class="noti-feed-content">
                       <div class="filter-tab">
                           <a href="" class="show-all-tab">
                               <span class="">All</span>
                           </a>
                           <a href="" class="show-friend-only">
                               <span class="">Friend</span>
                           </a>
                       </div>
                       <?php include 'backend\shared\notification.php'; ?>
                   </div>
               </div>
           </div>
        </div>
        <?php include 'backend\shared\right-section.php'; ?>
    </div>
</div>

<?php include 'backend\loadJsFiles.php'; ?>