<?php 
$pageTitle="Profile | WeLink";
Include_once 'backend\initialize.php'; 
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

    //Friend
    include 'backend\shared\friend_handlers.php';
}

include 'backend\shared\editProfile_handlers.php'; 

$user = $loadFromUser->userData($user_id);
$profileData = $loadFromUser->userData($profileId);
$date_joined = strtotime($profileData->signUpDate);

//FRIEND

// CHECK FRIENDS
$is_already_friends = $loadFromFriend->is_already_friends($_SESSION['userLoggedIn'], $profileData->user_id);
//  IF I AM THE REQUEST SENDER
$check_req_sender = $loadFromFriend->am_i_the_req_sender($_SESSION['userLoggedIn'], $profileData->user_id);
// IF I AM THE REQUEST RECEIVER
$check_req_receiver = $loadFromFriend->am_i_the_req_receiver($_SESSION['userLoggedIn'], $profileData->user_id);
// TOTAL REQUESTS
$get_req_num = $loadFromFriend->request_notification($_SESSION['userLoggedIn'], false);
// TOTAL FRIENDS
$get_frnd_num = $loadFromFriend->get_all_friends($_SESSION['userLoggedIn'], false);
 


$pageTitle= ''.$profileData->firstName.' '.$profileData->lastName.'(@'.$profileData->username.') | WeLink';
echo '
<script>
document.title = "'.$pageTitle.'";
</script>';

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>" data-pid ="<?php echo $profileData->user_id; ?>" data-profileun ="<?php echo $profileData->username; ?>" data-un ="<?php echo $user->username; ?>"  ></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php'; ?>
        <div class="mid-section col-sm-6"> 
           <div class="home-section container">
               <div class="home-header row">
                   <h2 class=""><?php echo $profileData->firstName.' '.$profileData->lastName; ?></h2>
                   <?php if(!empty($loadFromPosts->PostCounts($profileId))){ ?>
                    <div class="tweet-no"><?php echo $loadFromPosts->PostCounts($profileId); ?> Posts</div>
                    <?php } ?>
               </div>
               <div class="profile-user-container">
                    <div class="user-pic">
                        <img src="<?php echo url_for($profileData->profileImage); ?>" alt="<?php  echo $user->firstName.' '.$user->lastName;?>" class="">
                    </div>
                    <div class="user-profile-details">
                        <span class="name"><?php echo $profileData->firstName.' '.$profileData->lastName; ?></span>
                        <span class="username">@<?php echo $profileData->username;?></span>
                        <span class="description">
                        <svg viewBox="0 0 24 24" class=""><g><path d="M19.708 2H4.292C3.028 2 2 3.028 2 4.292v15.416C2 20.972 3.028 22 4.292 22h15.416C20.972 22 22 20.972 22 19.708V4.292C22 3.028 20.972 2 19.708 2zm.792 17.708c0 .437-.355.792-.792.792H4.292c-.437 0-.792-.355-.792-.792V6.418c0-.437.354-.79.79-.792h15.42c.436 0 .79.355.79.79V19.71z"></path><circle cx="7.032" cy="8.75" r="1.285"></circle><circle cx="7.032" cy="13.156" r="1.285"></circle><circle cx="16.968" cy="8.75" r="1.285"></circle><circle cx="16.968" cy="13.156" r="1.285"></circle><circle cx="12" cy="8.75" r="1.285"></circle><circle cx="12" cy="13.156" r="1.285"></circle><circle cx="7.032" cy="17.486" r="1.285"></circle><circle cx="12" cy="17.486" r="1.285"></circle></g></svg>
                        <span class="join">
                            Joined
                        </span>
                        <span class="description__date"><?php echo date("F Y",$date_joined); ?></span>
                        </span>
                        <div class="followersContainer">
                            <a href="<?php echo url_for($profileData->username.'/friend'); ?>" class="">
                            <span class="value count-friends"><?php echo $get_frnd_num ; ?></span> 
                            <span class="">Friends</span>
                            </a>
                        </div>
                    </div>
                    <div class="profileButtonContainer">
                        <div class="sign-up-btn row actions">
                            <?php
                            if($user_id!==$profileId){
                                if($is_already_friends){ ?>
                                    <a href="<?php echo h($_SERVER['PHP_SELF']).'?action=unfriend_req&id='.$profileData->user_id.''?>" class="req_actionBtn Button unfriend">Unfriend</a>
                                <?php }elseif($check_req_sender){ ?>
                                    <a href="<?php echo h($_SERVER['PHP_SELF']).'?action=cancel_req&id='.$profileData->user_id.''?>" class="req_actionBtn Button cancleRequest">Cancel Request</a>
                                <?php }elseif($check_req_receiver){ ?>
                                    <a href="<?php echo h($_SERVER['PHP_SELF']).'?action=ignore_req&id='.$profileData->user_id.''?>" class="req_actionBtn Button ignoreRequest">Ignore</a> 
                                    <a href="<?php echo h($_SERVER['PHP_SELF']).'?action=accept_req&id='.$profileData->user_id.''?>" class="req_actionBtn Button acceptRequest">Accept</a>
                                <?php }else { ?>
                                    <a href="<?php echo h($_SERVER['PHP_SELF']).'?action=send_req&id='.$profileData->user_id.''?>" class="req_actionBtn Button sendRequest">Send Request</a>
                               <?php }
                            }else{ ?>
                               <button type="button" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>;
                           <?php } ?>
                        </div>
                        <?php include 'backend\modal\setupProfileModal.php'; ?>
                    </div>
                </div>
               <div class="home-feed-container row">
                   <div class="home-feed-content">
                       <div class="filter-tab">
                           <a href="" class="show-all-tab">
                               <span class="">Posts</span>
                           </a>
                           <a href="" class="show-friend-only">
                               <span class="">Photos</span>
                           </a>
                       </div>
                       <section aria-label="Timeline:Your Home Timeline" class="profile postContainer">
                            <?php $loadFromPosts->postsProfile($user_id,$profileId,10)?>
                       </section>
                       <?php include 'backend\modal\deleteModal.php'; ?>
                   </div>
               </div>
           </div>
        </div>
        <?php include 'backend\shared\right-section.php'; ?>
    </div>
</div>

<?php include 'backend\loadJsFiles.php'; ?>

