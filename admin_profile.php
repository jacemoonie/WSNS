<?php $pageTitle="Profile | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 
 include 'backend\shared\editProfileAdmin.php';

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
               <div class="home-header row">
                   <h2 class="">Profile</h2>
               </div>
               <div class="adminProfile-user-container row">
                    <div class="user-pic">
                        <img src="<?php echo url_for($user->profileImage); ?>" alt="<?php  echo $user->firstName.' '.$user->lastName;?>" class="">
                    </div>
                    <div class="user-profile-details">
                        <span class="name"><?php echo $user->firstName.' '.$user->lastName; ?></span>
                        <span class="username">Username : <?php echo $user->username;?></span>
                        <span class="username">Email : <?php echo $user->email;?></span>
                    </div>
                </div>
               <div class="admin-update-profile row">
                    <h2 class="modal-title" id="editProfileModalLabel">Edit profile</h2>
                        <form class="editAdminProfileForm" action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="admin_id" id="user_id" value="<?php echo $user->admin_id;?>" class="">
                            <div class="mb-3">
                                <div class="profile-pic">
                                    <span class="text-uppercase name">Profile Picture</span>
                                    <img id="profilePic" src="<?php echo url_for($user->profileImage); ?>">
                                </div>
                                <div class="mt-3 px-4"> 
                                    <div class="d-flex flex-row align-items-center mt-2"> 
                                        <div class="ml-3"> 
                                            Select image to upload:
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <input type="button" id="remove-pic" value = "Remove">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                                <label for="firstName" class="col-form-label">First name</label>
                                <input type="text" name="firstName" class="form-control" id="firstName"  value="<?php echo $user->firstName;?>" autocomplete="off" >
                            </div>
                            <div class="mb-3">
                                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                                <label for="lastName" class="col-form-label">Last name</label>
                                <input type="text" name="lastName" class="form-control" id="lastName"  value="<?php echo $user->lastName;?>" autocomplete="off"  >
                            </div>
                            <div class="mb-3">
                                <?php echo $account->getError(Constants::$emailTaken); ?>
                                <?php echo $account->getError(Constants::$emailInvalid); ?>
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email"  value="<?php echo $user->email;?>" autocomplete="off" >
                            </div>
                            <div class="mb-3">
                                <?php echo $account->getError(Constants::$passwordDoNotMatch); ?>
                                <?php echo $account->getError(Constants::$passwordTooShort); ?>
                                <?php echo $account->getError(Constants::$passwordAlphaNumeric); ?>
                                <label for="password" class="col-form-label">New password</label>
                                <input type="password" name="password" class="form-control" id="password" autocomplete="off" >
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="col-form-label">Confirm new password</label>
                                <input type="password" name="password2" class="form-control" id="password2" autocomplete="off" >
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" class="" id="s-password" onclick="showPassword()">
                                <label for="s-password" class="">Show password</label> 
                            </div>
                            <div class="mb-3">
                                <input type="checkbox" class="" id="confirm-changes" required>
                                <label for="confirm-changes" class="">Confirm changes</label> 
                            </div>
                            <div class="signup modal-footer">
                                <button type="button" class="edit-cancel" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="edit-submit" name="save-edit" >Save</button>
                            </div>
                        </form>
                    </div>
               </div>
           </div>
    </div>
</div>

<?php include 'backend\loadJsFiles.php'; ?>
