<?php
Include_once 'backend\initialize.php'; 
Include_once 'backend\shared\header.php'; 

if(Login::isLoggedIn()){
    $userId = Login::isLoggedIn();
}else if(isset($_SESSION['userLoggedIn'])){
    $user_id = $_SESSION['userLoggedIn'];
    $status = 0;
    $loadFromUser->update("users",$user_id,array("userStatus"=>$status));
    log_out_user();
    redirect_to(url_for("index"));
    
}else if(isset($_SESSION['adminLoggedIn'])){
    $user_id = $_SESSION['adminLoggedIn'];
    log_out_admin();
    redirect_to(url_for("index"));
    
}else{
    redirect_to(url_for("index"));
}

$loadFromUser->delete('token',array("user_id"=>$userId));

if(isset($_COOKIE['FBID'])){
    unset($_COOKIE['FBID']);
    header('Refresh:0');
}
?>