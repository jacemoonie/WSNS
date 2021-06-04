<?php $pageTitle="Announcement | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 

 //check if user is logged in
if(isset($_SESSION['adminLoggedIn'])){
    $user_id = $_SESSION['adminLoggedIn'];
    $user = $admin->adminData($user_id);
    
}else if(isset($_SESSION['userLoggedIn'])){ 
    redirect_to(url_for("index"));
}else{
    redirect_to(url_for("admin.php"));
}

if(is_post_request()){
    if(isset($_POST['description']) && !empty(isset($_POST['description']))){
       $msg = h($_POST['description']);
       $createAnnouncement = $announce->createAnnouncement($msg);
       if(!$createAnnouncement){
           echo "FAILED TO CREATE ANNOUNCEMENT";
       }
    }

    if(isset($_POST['ann_id']) && !empty(isset($_POST['ann_id']))){
        $ann_id = h($_POST['ann_id']);
        $msg = h($_POST['edit-description']);
        $updateAnnouncement = $announce->updateAnnouncement($ann_id,$msg);
        if(!$updateAnnouncement){
            echo "FAILED TO UPDATE ANNOUNCEMENT";
        }
     }
}

?>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\admin-nav-bar.php';?>
            <div class="mid-section col-sm"> 
                <div class="announce-header container">
                   <h2 class="">Announcement</h2>
                   <a href="<?php echo url_for("messages/compose") ?>" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
                   <?php include 'backend\modal\createAnnouncement.php'; ?>
                   <?php include 'backend\modal\editAnnouncement.php'; ?>
               </div>
               <div class="announcement-list">
                    <?php echo $announce->recentAnnouncement(); ?>
                    <?php include 'backend\modal\deleteModal.php'; ?>
               </div>
           </div>
    </div>
</div>
<script src="<?php echo url_for('frontend\assets\js\Announcement.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
