<?php Include_once 'backend\shared\editProfile_handlers.php'; ?>
<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">
                <img src="frontend\assets\images\link-icon.svg" alt="" class="signup-modal-icon">
            </div>
        </div>
        <div class="edit-profile modal-body">
        <h2 class="modal-title" id="editProfileModalLabel">Edit profile</h2>
            <form class="editProfileForm" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $profileData->user_id;?>" class="">
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
                    <input type="text" name="firstName" class="form-control" id="firstName"  value="<?php echo $profileData->firstName;?>" autocomplete="off" >
                </div>
                <div class="mb-3">
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="lastName" class="col-form-label">Last name</label>
                    <input type="text" name="lastName" class="form-control" id="lastName"  value="<?php echo $profileData->lastName;?>" autocomplete="off"  >
                </div>
                <div class="mb-3">
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email"  value="<?php echo $profileData->email;?>" autocomplete="off" >
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