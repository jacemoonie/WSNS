<?php $pageTitle="Group | WeLink";
include 'backend\shared\main_header_functionality.php';

if(!isset($_GET['group'])){
    $groupId = "";
}else{
    $groupId = h($_GET['group']);
    $groupData = $loadFromGroup->groupDataByID($groupId);
    
    if(empty($groupId)){
        redirect_to(url_for("home"));
        $groupMembers = $loadFromGroup->groupMembers($groupId->groupID);
    }

}
?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="g-p-id" data-gid="<?php echo $groupId ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php';?>
        <div class="message-section col-sm-4"> 
           <div class="message-section container">
               <div class="message-header container">
                   <h2 class="">Group</h2>
                   <a href="<?php echo url_for("group/compose") ?>" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newGroupMessageModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
                   <?php include 'backend\modal\groupMessageModal.php'; ?>
                </div>
                <div class="messages-list-container">
                    <ul class="msg-user-add">

                    </ul>
                </div>
           </div>
        </div>
        <div class="right-section right-msg col-sm-5">
            <?php if(!isset($_GET['group'])):?>
            <div class="no-msg-container">
                <div class="n-msg-wrapper">
                    <h2 class="">You don't have a group message selected</h2>
                    <p class="">Choose one from your existing group messages or start a new one.</p>
                    <a href="<?php echo url_for("messages/compose") ?>" class="n-msg Button" role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newGroupMessageModal">New group message</a>
                    <?php include 'backend\modal\groupMessageModal.php'; ?>
                </div>
            </div>
            <?php elseif(isset($_GET['group'])) :?>
             <section class="chatMessageContainer" aria-labelledBy="detail header" aria-header='section header' role="region">
                 <div class="chat-header-top">
                    <div class="chat-header-left">
                        <a href="<?php echo url_for($groupData->groupName) ;?>" class="chat-header-image-wrapper">
                            <img src="<?php echo url_for($groupData->groupImage) ;?>" alt="<?php echo $groupData->groupName; ?>" class="">
                        </a>
                        <div class="chat-header-name-wrapper group">
                            <h3 class=""><?php echo $groupData->groupName; ?></h3>
                            <span class="chat-header-username">ID : 
                            <?php echo $groupData->groupID; ?>
                            </span>
                            <span class="chat-header-description"> 
                            <?php echo $groupData->groupDescription; ?>
                            </span>
                            <div class="username-container">Members : 
                            <?php $members = $loadFromGroup->groupMembers($groupId);
                                foreach($members as $member){
                                    $userData = $loadFromUser->userData($member->user_id);
                                    if($user_id!=$userData->user_id){
                                        echo ' <span class="chat-header-description"> @'.$userData->username.'</span>';
                                    }else{
                                        echo ' <span class="chat-header-description">@You</span>';
                                    }
                                }
                            ?>
                            </div>
                            </div>
                            
                        <?php if($groupData->groupCreatedBy == $user_id) {?>
                        <div class="group-edit-btn group">
                            <button data-editgroupdata ="<?php echo $groupId; ?>" data-userid ="<?php echo $user_id; ?>"  class="edit-group-btn" data-bs-toggle="modal" data-bs-target="#editGroupModal">
                                <img src="<?php echo url_for('frontend\assets\images\edit-button.png'); ?>" alt="" class="">
                            </button>
                            <?php include 'backend\modal\editGroupModal.php'; ?>
                        </div>
                        <?php } ?>
                    </div>
                 </div> 
                 <div class="chatPageContainer">
                     <div class="mainChatContainer">
                         <div class="msg-details">
                             <div class="msg-show-wrap">
                                 <div class="user-info" data-userid="<?php echo $user_id ;?>" data-groupid="<?php echo $groupData->groupID;?>"></div>
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
<script src="<?php echo url_for('frontend\assets\js\groupMessage.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
<script>
    $uid = $(".u-p-id").data("uid");
    $gid = $(".g-p-id").data("gid");
    $(document).ready(function(){

        $(document).on("click",".msg-user-name-wrap",function(){
            var groupId = $(this).data("groupid");
            if(groupId !="" && groupId != undefined){
                window.location.href = "http://localhost/WSNS/group/"+groupId;
            }
            
        })
        //LOAD RECENT CHAT
        function loadGroupList(){
            $.post("http://localhost/WSNS/backend/ajax/fetchGroupMessage.php",{userIdLoadGroupList:$uid,LoadgroupId:$gid},function(data){
                // console.log(data);
                $('ul.msg-user-add').html(data);
                // alert(data);
            })
        }
        
        function loadRecentChat(){
            $.post("http://localhost/WSNS/backend/ajax/fetchGroupMessage.php",{userId:$uid,groupMsgId:$gid},function(data){
                $('.msg-box').html(data);
            // alert(data);
            })  
        }
        
        loadGroupList();

        //FOR SENDING MESSAGES
        var userid = $(".user-info").data("userid");
        var otherid = $(".user-info").data("groupid");
        var userIdForAjax,otherIdForAjax;
        function xyz(name,surname,callback){
            if(typeof callback == 'function'){
                callback(name,surname);
            }else{
                alert('Argument is not function type');
            }
        }

        function abc(var1,var2){
            if(var1==undefined || var2==undefined){
                return userIdForAjax=userid,otherIdForAjax=otherid;
            }else{
                return userIdForAjax=var1,otherIdForAjax=var2;
            }
        }

        //SEND MESSAGE
        setTimeout(function(){
            $(document).on("keyup","#sendMsgBtn",function(e){
                var thisEl = $(this);
                var rawMsg = $(this).val();
                if(rawMsg !=""){
                    //USER enter ENTER key
                    if(e.which == 13 || e.keycode == 13){
                        if(userIdForAjax == undefined){
                            xyz(userIdForAjax,otherIdForAjax,abc);
                        }
                        //    console.log(rawMsg,userIdForAjax,otherIdForAjax)
                            $.ajax({
                                type:"POST",
                                url:"http://localhost/WSNS/backend/ajax/sendGroupMessage.php",
                                data:{
                                    userIdForAjax:userIdForAjax,
                                    otherIdForAjax:otherIdForAjax,
                                    msg:rawMsg
                                },
                                success:function(data){
                                    // console.log(data);
                                    $('#sendMsgBtn').val("");
                                }
                            })
                            
                    }
                }

                })
        }, 500);

        function loadMessage(){
            $.ajax({
                    type:"POST",
                    url:"http://localhost/WSNS/backend/ajax/sendMessage.php",
                    data:{
                        yourId:userid,
                        showMsg:otherid
                    },
                    success:function(data){
                        loadGroupList();
                        loadRecentChat();
                        // $('.msg-box').html(data);
                    }
                })
        }
        
        var loadTimer = setInterval(() => {
            loadMessage();
        }, 1000);
    })
</script>
