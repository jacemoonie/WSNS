<?php
$user_id = $_SESSION['userLoggedIn'];
$status = $verify->getVerifyStatus("status",$user_id);

// if(Login::isLoggedIn()){
//     redirect_to(url_for('home'));
// }else if(isset($_SESSION['userLoggedIn']) && $status->status=='1'){
//     redirect_to(url_for('home'));
// }
  

$errors=array();

//if user submit code
if(is_post_request()){

    $user_id = (int)($_SESSION['userLoggedIn']);

    if(isset($_POST['verifyCode'])){

        echo $_POST['verifyCode'];
        $code = FormSanitizer::formSanitizerString($_POST['verifyCode']); 
        $verifyCode = $verify->verifyCode("*",$code);
        if($verifyCode){
          if(date('Y-m-d',strtotime($verifyCode->createdAt)) < date('Y-m-d')){
              $errors['verifyCode'] = "Your verification code has been expired.";
          }else{
                $loadFromUser->update("verification",$user_id,array("code"=>$code,"status"=>1));
                redirect_to(url_for("home"));
          }
      }else{
        $errors['verify'] = "Invalid verification code";  
      }
    }

}else{
    //Send code
    if(isset($_SESSION['userLoggedIn'])){
        $user_id = (int)($_SESSION['userLoggedIn']);
        $user = $loadFromUser->userData($user_id);
        
        // $loadFromUser->create("users",['user_id'=>1,"profileEdit"=>0]);
        $verificationCode = $verify->generateCode(); 
        $message= "{$user->firstName}, Your account has been created, Your code $verificationCode";
        $subject= "[WELINK] Please verify your account";
        $verify->sendToMail($user->email,$message,$subject); //send verification email
        $loadFromUser->create("verification",["user_id"=>$user_id,"code"=>$verificationCode]); //save verficaton data
    }else{
        redirect_to(url_for("index"));
    }
}



?>