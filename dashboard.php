<?php $pageTitle="Dashboard | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 

 //check if user is logged in
if(isset($_SESSION['adminLoggedIn'])){
    $user_id = $_SESSION['adminLoggedIn'];
    
}else if(isset($_SESSION['userLoggedIn'])){ 
    redirect_to(url_for("index"));
}else{
    redirect_to(url_for("admin.php"));
}

$user = $admin->adminData($user_id);

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\admin-nav-bar.php';?>
        <div class="mid-section col-sm"> 
           <div class="home-section container">
               <div class="home-header row">
                   <h2 class="">Dashboard</h2>
               </div>
               <div class="statistic row">
                <div class="statistic-content container">
                    <div class="user-online col">
                        <div class="online-wrapper">
                            <h3 class="">Users Online</h3><span class="green-dot"></span>
                        <span class="user-online-counter"><?php echo $loadFromUser->userOnline();?></span>
                    </div>
                    </div>
                    <div class="websites-views col">
                        <h3 class="websites-view">Sites views</h3>
                        <span class="website-views-counter"><?php echo $admin->sitesViewCounter() ?></span>
                    </div>
                </div>  
               </div>
               <div class="recent-user row">
                <div class="recent col"><h3 class="">Recent Users activity</h3></div>
                <div class="home-feed-container row">
                   <div class="home-feed-content">
                       <div class="filter-tab">
                           <a href="" class="active show-posts-tab">
                               <span class="">Posts</span>
                           </a>
                           <a href="" class="show-event-only">
                               <span class="">Events</span>
                           </a>
                       </div>
                       <section aria-label="Timeline:Your Home Timeline" id="myDIV" class="postContainer">
                       <?php $loadFromPosts->allPosts($user_id,10);?>
                       </section>
                   </div>
               </div>
               </div>
           </div>
        </div>
    </div>
</div>
<script src="<?php echo url_for('frontend\assets\js\admin.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
