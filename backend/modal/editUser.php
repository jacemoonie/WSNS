<!-- Edit user Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
        <div class="modal-header">
            <h3 class="modal-title" id="editUserModalLabel">Edit user</h3>
        </div>
        <div class="signup modal-body">
        <form class="editProfileForm" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="euser_id" id="euser_id" value="" class="">
                <div class="mb-3">
                    <div class="profile-pic">
                        <span class="text-uppercase name">Profile Picture</span>
                        <img id="editprofilePic" src="">
                    </div>
                    <div class="mt-3 px-4"> 
                        <div class="d-flex flex-row align-items-center mt-2"> 
                            <div class="ml-3"> 
                                Select image to upload:
                                <input type="file" name="editfileToUpload" id="editfileToUpload">
                                <input type="button" id="editremove-pic" value = "Remove">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <label for="efirstName" class="col-form-label">First name</label>
                    <input type="text" name="efirstName" class="form-control" id="edit-firstName"  value="" autocomplete="off" >
                </div>
                <div class="mb-3">
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <label for="elastName" class="col-form-label">Last name</label>
                    <input type="text" name="elastName" class="form-control" id="edit-lastName"  value="" autocomplete="off"  >
                </div>
                <div class="mb-3">
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <label for="eemail" class="col-form-label">Email</label>
                    <input type="email" name="eemail" class="form-control" id="edit-email"  value="" autocomplete="off" >
                </div>
                <div class="mb-3">
                    <?php echo $account->getError(Constants::$passwordDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordTooShort); ?>
                    <?php echo $account->getError(Constants::$passwordAlphaNumeric); ?>
                    <label for="epassword" class="col-form-label">New password</label>
                    <input type="password" name="eassword" class="form-control" id="edit-password" autocomplete="off" >
                </div>
                <div class="mb-3">
                    <label for="epassword2" class="col-form-label">Confirm new password</label>
                    <input type="password" name="epassword2" class="form-control" id="edit-password2" autocomplete="off" >
                </div>
                <div class="mb-3">
                    <input type="checkbox" class="" id="s-password-user">
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
   
<script src="<?php echo url_for('frontend\assets\js\showPassword.js'); ?>"></script>  
<script src="<?php echo url_for('frontend\assets\js\User.js'); ?>"></script>                