<?php $pageTitle="Group | WeLink";
include_once 'backend\shared\main_header_functionality.php';

if(!isset($_GET['message'])){
    $otheruserid = "";
}else{
    $otheruserid = h($_GET['message']);
    $otheruserData = $loadFromUser->userData($otheruserid);
    if(empty($otheruserData)){
        redirect_to(url_for("home"));
    }

}
if(is_post_request()){

    if(isset($_POST['userId']) && !empty($_POST['userId'])){
         $groupName = FormSanitizer::formSanitizerName($_POST['groupName']);
         $groupDescription = h($_POST['groupDescription']);
         $groupCreatedBy = $_POST['userId'];

        if(!empty($groupCreatedBy)){
            $createGroup = $loadFromUser->create("`group`",array("groupName"=>$groupName,"groupDescription"=>$groupDescription,"groupCreatedBy"=>$groupCreatedBy));
            if($createGroup){
                echo "Group Created!";
            }
        }
    }
}
?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php';?>
        <div class="message-section col-sm-4"> 
           <div class="message-section container">
               <div class="message-header container">
                   <h2 class="">Group</h2>
                   <a href="<?php echo url_for("messages/compose") ?>" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newGroupMessageModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
               </div>
                <div class="messages-list-container">
                    <ul class="msg-user-add">
                    </ul>
                </div>
           </div>
        </div>
        <div class="right-section right-msg col-sm-5">
            <?php if(!isset($_GET['message'])):?>
            <div class="no-msg-container">
                <div class="n-msg-wrapper">
                    <h2 class="">You don't have a group message selected</h2>
                    <p class="">Choose one from your existing group messages or start a new one.</p>
                    <a href="<?php echo url_for("messages/compose") ?>" class="n-msg Button" role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newGroupMessageModal">New group message</a>
                    <?php include 'backend\modal\groupMessageModal.php'; ?>
                </div>
            </div>
            <?php elseif(isset($_GET['message'])) :?>
             <section class="chatMessageContainer" aria-labelledBy="detail header" aria-header='section header' role="region">
                 <div class="chat-header-top">
                    <div class="chat-header-left">
                        <a href="<?php echo url_for($otheruserData->username) ;?>" class="chat-header-image-wrapper">
                            <img src="<?php echo url_for($otheruserData->profileImage) ;?>" alt="<?php echo $otheruserData->firstName.' '.$otheruserData->lastName; ?>" class="">
                        </a>
                        <div class="chat-header-name-wrapper">
                            <h3 class=""><?php echo $otheruserData->firstName.' '.$otheruserData->lastName; ?></h3>
                            <span class="chat-header-username">@
                            <?php echo $otheruserData->username; ?>
                            </span>
                        </div>
                    </div>
                 </div> 
                 <div class="chatPageContainer">
                     <div class="mainChatContainer">
                         <div class="msg-details">
                             <div class="msg-show-wrap">
                                 <div class="user-info" data-userid="<?php echo $user_id ;?>" data-otherid="<?php echo $otheruserData->user_id;?>"></div>
                                 <div class="empty-space">
                                     <div class="msg-box">
                                     <!-- MESSAGE HERE -->
                                    </div>
                                 </div>
                            </div>
                         <aside class="chat-footer" aria-label="Start a new message" role="complementary">
                            <textarea name="messageInput" id="sendMsgBtn" placeholder="Start a new message" aria-label="Start a new message" class=""></textarea>
                            <button role="button" class="msg-send-btn"id="sendMsgBtn">
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="paper-plane" class="svg-inline--fa fa-paper-plane fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M440 6.5L24 246.4c-34.4 19.9-31.1 70.8 5.7 85.9L144 379.6V464c0 46.4 59.2 65.5 86.6 28.6l43.8-59.1 111.9 46.2c5.9 2.4 12.1 3.6 18.3 3.6 8.2 0 16.3-2.1 23.6-6.2 12.8-7.2 21.6-20 23.9-34.5l59.4-387.2c6.1-40.1-36.9-68.8-71.5-48.9zM192 464v-64.6l36.6 15.1L192 464zm212.6-28.7l-153.8-63.5L391 169.5c10.7-15.5-9.5-33.5-23.7-21.2L155.8 332.6 48 288 464 48l-59.4 387.3z"></path></svg>
                            </button>
                         </aside>
                     </div>
                 </div> 
             </section>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'backend\loadJsFiles.php'; ?>

