<?php $pageTitle="Messages | WeLink";
include_once 'backend\shared\main_header_functionality.php';

if(!isset($_GET['message'])){
    $otheruserid = "";
}else{
    $otheruserid = h($_GET['message']);
    $otheruserData = $loadFromUser->userData($otheruserid);
}
?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php';?>
        <div class="message-section col-sm-4"> 
           <div class="message-section container">
               <div class="message-header container">
                   <h2 class="">Messages</h2>
                   <a href="<?php echo url_for("messages/compose") ?>" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newMessageModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
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
                    <h2 class="">You don't have a message selected</h2>
                    <p class="">Choose one from your existing messages or start a new one.</p>
                    <a href="<?php echo url_for("messages/compose") ?>" class="n-msg Button" role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#newMessageModal">New messages</a>
                    <?php include 'backend\modal\messageModal.php' ?>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>
<script>
    $uid = $(".u-p-id").data("uid")
    $(document).ready(function(){
        $(document).on("click",".msg-user-name-wrap",function(){
            var otheruserid = $(this).data("profileid");
            if(otheruserid !="" && otheruserid != undefined){
                window.location.href = "http://localhost/WSNS/messages/"+otheruserid;
            }
            
        })
        function userLoadRecentMessage(){
            var otheruserid = '<?php echo $otheruserid ;?>';
            $.post("http://localhost/WSNS/backend/ajax/fetchMessage.php",{loadUserid:$uid,otheruserid:otheruserid},function(data){
                $('ul.msg-user-add').html(data);
            })
        }
        userLoadRecentMessage();
    })
</script>
<?php include 'backend\loadJsFiles.php'; ?>