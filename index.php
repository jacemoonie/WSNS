<?php 
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 
$pageTitle="WeLink - Social Networking Site | WSNS";

 //check if user is logged in
if(isset($_SESSION['userLoggedIn'])){
    $user_id = $_SESSION['userLoggedIn'];
    redirect_to(url_for("home"));  
}

$admin->updateViews();

?>
    <div class="index container-fluid">
        <div class="row">
            <div class="left-index col-sm">
                <div class="left-index-content row">
                    <div class="left-heading col"><h2 class="">WeLink - Social Networking Sites</h2></div>
                    <img src="<?php echo url_for('frontend\assets\images\indexImage.jpeg');?>" alt="" class="">
                </div>
            </div>
            <div class="right-index col-sm">
                <div class="right-index-content row">
                    <div class="right-index-icon col">
                        <img src="<?php echo url_for('frontend\assets\images\link-icon.svg');?>" alt="" class="">
                    </div>
                    <div class="heading row">
                        <h1 class="">Happening Now</h1>
                    </div>
                    <div class="paragraph">
                        <p class="">Join WeLink today.</p>
                    </div>
                    <div class="sign-up-btn row">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</button>
                    </div>
                    <?php include 'backend\modal\signupModal.php' ?>
                    <div class="log-in-btn row">
                        <a href="login" type="button" class="">Log in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  </body>
</html>
<script src="<?php echo url_for('frontend\assets\js\showPassword.js'); ?>"></script>