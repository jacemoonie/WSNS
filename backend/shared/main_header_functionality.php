<?php
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 

$user_id = $_SESSION['userLoggedIn'];
$status = $verify->getVerifyStatus("status",$user_id);

//check if user is logged in
if(isset($_SESSION['userLoggedIn']) && $status->status === "1"){
    $user_id = $_SESSION['userLoggedIn'];
    
}else if(Login::isLoggedIn()){
    $user_id = Login::isLoggedIn();
}else{
    redirect_to(url_for("index"));
}

if(is_get_request()){

    if(isset($_GET['username']) && !empty($_GET['username'])){
      $username = FormSanitizer::formSanitizerString($_GET['username']);
      $profileID = $loadFromUser->userIdByUsername($username);
      if(!$profileID){
          redirect_to(url_for("home")); 
      }else{
          $profileId = $profileID;
      }
    }else{
        $profileId = $user_id;
    }
}

$user = $loadFromUser->userData($user_id);
?>