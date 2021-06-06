<?php $pageTitle="Log in | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php';  
 include 'backend\shared\login_handlers.php';
?>
<div class="container-fluid login">
    <div class="login-form-content row">
        <div class="login col-sm">
            <div class="login-icon row">
                <img src="frontend\assets\images\link-icon.svg" alt="" class="">
            </div>
            <div class="login-header row">
                <h2 class="">Log in to WeLink</h2>
            </div>
            <div class="login-form row">
                <form class="loginForm" action="<?php echo h($_SERVER['PHP_SELF']);?>" method="POST" >
                    <div class="mb-3">
                        <?php echo $account->getError(Constants::$loginUsernameEmailWrong); ?>
                        <label for="username" class="col-form-label">Username or Email</label>
                        <input type="text" name="username" class="form-control" value="<?php getInputValue('username');?>" id="username" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <?php echo $account->getError(Constants::$loginPasswordWrong); ?>
                        <label for="password" class="col-form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="" id="s-password" onclick="showLoginPassword()">
                        <label for="s-password" class="">Show password</label> 
                    </div>
                    <div class="log-in-btn row">
                        <button  class="">Log in</button>
                    </div>
                </form>
            </div>
            <div class="login-footer row">
                <span class="login-footer">
                    <a href="" class="">Forgot password?</a> · <a href="" data-bs-toggle="modal" data-bs-target="#signupModal" class="">Sign up for Welink</a><?php include 'backend\modal\signupModal.php' ?></span>
            </div>               
        </div>
    </div>
</div>
<?php include 'backend\loadJsFiles.php'; ?>

