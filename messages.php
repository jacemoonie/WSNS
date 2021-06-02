<?php $pageTitle="Notification | WeLink";
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
}

$user = $loadFromUser->userData($user_id);
?>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php';?>
        <div class="message-section col-sm-4"> 
           <div class="message-section container">
               <div class="message-header container">
                   <h2 class="">Messages</h2>
                   <a href="<?php echo url_for("messages/compose") ?>" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newMessageModal"><img height="20px" width="20px" src="frontend\assets\images\plus-sign.png" alt="" class=""></a>
               </div>
                <div class="messages-list">
                    <div class="message">
                        <div class="user-photo col-3">
                            <img src="frontend\assets\images\defaultPic.svg" alt="" class="">
                        </div>
                        <div class="user-name-details col-2">
                            <span class="name">Name</span>
                            <span class="username">@Username</span>
                            <div class="messages">
                                <article class="message">
                                    This is the message.
                                </article>
                            </div>
                        </div>
                        <div class="message-date col-2">
                            May 29, 2021
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <div class="right-section right-msg col-sm-5">
            <div class="no-msg-container">
                <div class="n-msg-wrapper">
                    <h2 class="">You don't have a message selected</h2>
                    <p class="">Choose one from your existing messages or start a new one.</p>
                    <a href="<?php echo url_for("messages/compose") ?>" class="n-msg Button" role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newMessageModal">New messages</a>
                    <?php include 'backend\modal\messageModal.php' ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'backend\loadJsFiles.php'; ?>