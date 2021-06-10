<?php 
$pageTitle="Verify your Account";
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 
Include 'backend\shared\verify_handlers.php';

?>
<?php require_once 'backend\shared\header.php';?>
<section class="signup-container">
    <div class="form-container">
        <div class="form-content">
        <?php if(isset($_POST['verifyCode']) || !empty($POST['verifyCode'])){
                if(isset($errors['verify'])){
                    echo '
                <div class="container">
                <div class="row">
                    <div class="alert alert-success col-md-12" role="alert" id="notes">
                    <h4>NOTES</h4>
                    <ul>
                        <li><span style="color:red;">'.$errors['verify'].'</span>. Please re-enter the code or request a new code.</li>
                        <li>If somehow, you did not recieve the verification email then <a href="'.url_for("verification").'">resend the verification email</a></li>
                    </ul>
                    </div>
                    </div>
                    <!-- Verification Entry Jumbotron -->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="jumbotron text-center">
                            <h2>Enter the verification code</h2>
                            <form method="post" action="'.h($_SERVER['PHP_SELF']).'" role="form">
                            <div class="col-md-9 col-sm-12">
                                <div class="form-group form-group-lg">
                                <input type="text" class="form-control col-md-6 col-sm-6 col-sm-offset-2" name="verifyCode" required>
                                <input class="btn btn-primary btn-lg col-md-2 col-sm-2" type="submit" value="Verify">
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
                </div>';
                }
            }else{    
         ?>
        <div class="container">
        <!-- Instructions -->
        <?php if(isset($_SESSION['userLoggedIn'])){
            $user_id = $_SESSION['userLoggedIn'];
            $status = $verify->getVerifyStatus("status",$user_id);
            if($status->status !== "1"){ ?>
                <div class="row">
                <div class="alert alert-success col-md-12" role="alert" id="notes">
                <h4>NOTES</h4>
                <ul>
                    <li>Please verify your email. You will recieve a verification code on your mail. Enter that code below.</li>
                    <li>If somehow, you did not recieve the verification email then <a href="javascript:window.location.reload(true); alert('Verification email is resend.');">resend the verification email</a></li>
                </ul>
                </div>
                </div> 
            <?php }else{ ?>
                <div class="row">
            <div class="alert alert-success col-md-12" role="alert" id="notes">
            <h4>NOTES</h4>
            <ul>
                <li>You will recieve a verification code on your mail after you registered. Enter that code below.</li>
                <li>If somehow, you did not recieve the verification email then <a href="javascript:window.location.reload(true); alert('Verification email is resend.');">resend the verification email</a></li>
            </ul>
            </div>
            </div>
           <?php }?>
        <?php } ?>
        
        <!-- Verification Entry Jumbotron -->
        <div class="row">
            <div class="col-md-12">
            <div class="jumbotron text-center">
                <h2>Enter the verification code</h2>
                <form method="post" action="<?php echo h($_SERVER['PHP_SELF']);?>" role="form">
                <div class="col-md-9 col-sm-12">
                    <div class="form-group form-group-lg">
                    <input type="text" class="form-control col-md-6 col-sm-6 col-sm-offset-2" name="verifyCode" required>
                    <input class="btn btn-primary btn-lg col-md-2 col-sm-2" type="submit" value="Verify">
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <?php } ?>
    </div>
    </div>
</section>


</body>
</html>