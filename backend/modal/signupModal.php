<?php Include_once 'backend\shared\register_handler.php'; ?>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content signup">
        <div class="modal-header">
            <div class="modal-icon">
                <img src="frontend\assets\images\link-icon.svg" alt="" class="signup-modal-icon">
            </div>
        </div>
        <div class="signup modal-body">
        <h5 class="modal-title" id="signupModalLabel">Create your account</h5>
            <form class="signupForm" action="<?php echo h($_SERVER['PHP_SELF']);?> " method="POST">
            <div class="mb-3">
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <label for="firstName" class="col-form-label">First name</label>
                <input type="text" name="firstName" class="form-control" id="firstName"  value="<?php getInputValue('firstName');?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <label for="lastName" class="col-form-label">Last name</label>
                <input type="text" name="lastName" class="form-control" id="lastName"  value="<?php getInputValue('lastName');?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <label for="email" class="col-form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email"  value="<?php getInputValue('email');?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <?php echo $account->getError(Constants::$passwordDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordTooShort); ?>
                <?php echo $account->getError(Constants::$passwordAlphaNumeric); ?>
                <label for="password" class="col-form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="password2" class="col-form-label">Confirm Password</label>
                <input type="password" name="password2" class="form-control" id="password2" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <input type="checkbox" class="" id="s-password" onclick="showPassword()">
                <label for="s-password" class="">Show password</label> 
            </div>
            <div class="signup modal-footer">
                <button type="button" class="signup-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="signup-submit">Sign up</button>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>
   
<script src="<?php echo url_for('frontend\assets\js\showPassword.js'); ?>"></script>                 