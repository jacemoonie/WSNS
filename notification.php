<?php $pageTitle="Notification | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 
include 'backend\shared\friend_handlers.php'; 

$user_id = $_SESSION['userLoggedIn'];
$status = $verify->getVerifyStatus("status",$user_id);

//check if user is logged in
if(isset($_SESSION['userLoggedIn']) && $status->status === "1"){
    $user_id = $_SESSION['userLoggedIn'];
    
}else{
    redirect_to(url_for("index"));
}

$user = $loadFromUser->userData($user_id);

//Notification for friend request
// TOTAL REQUESTS
$get_req_num = $loadFromFriend->request_notification($_SESSION['userLoggedIn'], false);
// TOTAL FRIENDS
$get_frnd_num = $loadFromFriend->get_all_friends($_SESSION['userLoggedIn'], false);
$get_all_req_sender = $loadFromFriend->request_notification($_SESSION['userLoggedIn'], true);

if(is_get_request())
{
    if(isset($_GET['type'])){
        $type = $_GET['type'];
        $id = $_GET['id'];
        $notid = $_GET['notid'];

        if($type == "message"){
            $updateNoti = $loadFromNotification->update("notification",$notid,array("status"=>"1"));
            if($updateNoti){
                redirect_to(url_for("messages/".$id));
            }
        }

        if($type == "groupMessage"){
            $updateNoti = $loadFromNotification->update("notification",$notid,array("status"=>"1"));
            if($updateNoti){
                redirect_to(url_for("group/".$id));
            }
        }

        if($type == "acceptFriend"){
            $updateNoti = $loadFromNotification->update("notification",$notid,array("status"=>"1"));
            if($updateNoti){
                redirect_to(url_for("messages/".$id));
            }
        }
    }
}
?>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php' ?>
        <div class="mid-section col-sm-6"> 
           <div class="home-section container">
               <div class="noti-header row">
                   <h2 class="">Notification</h2>
               </div>
               <div class="noti-feed-container row">
                   <div class="noti-feed-content">
                        <ul class="msg-user-add">
                            <?php $loadFromNotification->showNotification($user_id); ?>
                        </ul>
                   </div>
               </div>
           </div>
        </div>
        <?php include 'backend\shared\right-section.php'; ?>
    </div>
</div>

<?php include 'backend\loadJsFiles.php'; ?>
