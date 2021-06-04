<?php $pageTitle="Profile | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 
include 'backend\shared\editProfile_handlers.php'; 

 //check if user is logged in
if(isset($_SESSION['adminLoggedIn'])){
    $user_id = $_SESSION['adminLoggedIn'];
    $user = $admin->adminData($user_id);
    
}else if(isset($_SESSION['userLoggedIn'])){ 
    redirect_to(url_for("index"));
}else{
    redirect_to(url_for("admin.php"));
}

?>
<div class="u-p-id" data-uid="<?php echo $user_id ?>"></div>
<div class="container-fluid homepage">
    <div class="homepage-section row">
        <?php include 'backend\shared\admin-nav-bar.php';?>
            <div class="mid-section col-sm"> 
                <div class="announce-header container">
                   <h2 class="">Users</h2>
                   <a href="" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#createUserModal"><img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class=""></a>
                   <?php include 'backend\modal\createUser.php'; ?>
                  
               </div>
               <div class="announcement-list">
               <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-7">
                                        <a href="#" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Export to Excel</span></a>						
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>						
                                        <th>Username</th>
                                        <th>Date Joined</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $loadFromUser->allUserData();?>
                                    <?php include 'backend\modal\editUser.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>     
               </div>
           </div>
    </div>
</div>
<script src="<?php echo url_for('frontend\assets\js\Announcement.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
