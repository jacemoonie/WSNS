<?php $pageTitle="Admin log in | WeLink";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php';  

//check if user login
if(isset($_SESSION['adminLoggedIn'])){
    redirect_to(url_for("dashboard"));
}


if(is_post_request()){
   
    if(isset($_POST['username']) && !empty($_POST['username'])){
        
        $username=FormSanitizer::formSanitizerName($_POST['username']);
        $pass=FormSanitizer::formSanitizerString($_POST['password']);
        // echo $pass_hash=password_hash($pass,PASSWORD_BCRYPT);
        $wasSuccessful = $account->adminLogin($username,$pass);
        if($wasSuccessful){
            
            $admin_id = $wasSuccessful;
            $_SESSION['adminLoggedIn'] = $wasSuccessful;

            redirect_to(url_for('dashboard'));

        }
    }

}
?>
<div class="container-fluid login">
    <div class="login-form-content row">
        <div class="login col-sm">
            <div class="login-icon row">
                <img src="frontend\assets\images\link-icon.svg" alt="" class="">
            </div>
            <div class="login-header row">
                <h2 class="">WeLink Admin Log in</h2>
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
                    <a href="" class="">Forgot password?</a> · <a href="<?php echo url_for('index'); ?>"  class="">Back to website</a></span>
            </div>               
        </div>
    </div>
</div>
<?php include 'backend\loadJsFiles.php'; ?>

