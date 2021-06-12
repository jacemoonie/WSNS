<?php $pageTitle="Manage users | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 
Include 'backend\shared\addUser.php';
include 'backend\shared\editUser_handlers.php';

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
                   <a href="" class="n-msg " role="button" data-focusable="true" data-bs-toggle="modal" data-bs-target="#createUserModal">
                       <img height="20px" width="20px" src="<?php echo url_for('frontend\assets\images\plus-sign.png');?>" alt="" class="">
                    </a>
                   <?php include 'backend\modal\createUser.php'; ?>
                  
               </div>
               <div class="table-title">
                    <div class="row">
                        <div class="col-sm-7">
                            <input id="pdf-button" class="Button" type="button" value="Download PDF" />					
                        </div>
                    </div>
                </div>
               <div class="users-list" id="users-list">
               <div class="container-xl">
                    <div class="table-responsive">
                        <div class="table-wrapper">
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
                                <tbody class="user">
                                    <?php $loadFromUser->allUserData();?>
                                    <?php include 'backend\modal\editUser.php'; ?>
                                </tbody>
                            </table>
                            <div id="container" style="display:none;">
                                <div id="main">
                                    <div id="header">
                                    <div id="header_info black">1234 Made Up LN <span class="black">|</span> (555)-555-5555 <span class="black">|</span> wsns.com</div>
                                    </div>
                                    <h1 class="black" id="quote_name">WeLink | Users List Report</h1>
                                    <table id="phase_details">
                                    <thead>
                                        <tr>
                                        <th class="title">User ID</th>
                                        <th class="title">Name</th>
                                        <th class="title">Username</th>
                                        <th class="title">Email</th>
                                        <th class="title">Date Joined</th>
                                        </tr>
                                    </thead>
                                        <?php $loadFromUser->allUserDataTable();?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>     
               </div>
           </div>
    </div>
</div>

<script src="<?php echo url_for('frontend\assets\js\User.js'); ?>"></script>
<?php include 'backend\loadJsFiles.php'; ?>
