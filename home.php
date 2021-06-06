<?php $pageTitle="Home | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 

 //check if user is logged in
if(isset($_SESSION['userLoggedIn'])){
    $user_id = $_SESSION['userLoggedIn'];
    $status = $verify->getVerifyStatus("status",$user_id);
    if($status->status !== "1"){
        redirect_to(url_for("verification"));
    }
    
}else if(Login::isLoggedIn()){
    $user_id = Login::isLoggedIn();
}else{
    redirect_to(url_for("index"));
}

$user = $loadFromUser->userData($user_id);

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\nav-bar.php';?>
        <div class="mid-section col-sm-6"> 
           <div class="home-section container">
               <div class="home-header row">
                   <h2 class="">Home</h2>
               </div>
               <div class="home-post row">
                   <div class="home-post container">
                       <div class="user-photo">
                           <img src="<?php echo url_for($user->profileImage); ?>" alt="" class="">
                       </div>
                       <form action="">
                            <div class="post-container-text">
                                <textarea id="postTextarea" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div class="post-submit-btn">
                                <button type="submit" id="submitPostButton" class="">Post</button>
                            </div>
                       </form>
                   </div>
               </div>
               <div class="home-feed-container row">
                   <div class="home-feed-content">
                       <div class="filter-tab">
                           <a href="#" class="active show-all-tab">
                               <span class="">All</span>
                           </a>
                           <a href="#" class="show-friend-only">
                               <span class="">Friend</span>
                           </a>
                       </div>
                       <section aria-label="Timeline:Your Home Timeline" class="postContainer">
                            <?php $loadFromPosts->allPosts($user_id,10)?>
                       </section>
                       <?php include 'backend\modal\deleteModal.php'; ?>
                   </div>
               </div>
           </div>
        </div>
        <?php include 'backend\shared\right-section.php'; ?>
    </div>
</div>
<script src="<?php echo url_for('frontend\assets\js\delete.js'); ?>"></script>
<script src="<?php echo url_for('frontend\assets\js\home.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
<script>
    $uid = $(".u-p-id").data("uid");
    $(document).ready(function(){
       
        //LOAD RECENT ANNOUNCEMENT
        function userLoadRecentAnnouncement(){
            
            $.post("http://localhost/WSNS/backend/ajax/fetchAnnouncementHome.php",function(data){
                // alert(data);
                $('.announcement-post-content').html(data);
            })
        }
        //LOAD RECENT POST
        function userLoadRecentPosts(){
            
            $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostsHome:$uid},function(data){
                // console.log(data);
                $('.postContainer').html(data);
            })
        }

        //LOAD RECENT EVENT

        var loadTimer = setInterval(() => {
            userLoadRecentPosts();
            userLoadRecentAnnouncement();
        }, 1000);
    })
</script>