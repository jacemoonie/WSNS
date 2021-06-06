<?php
ob_start();

date_default_timezone_set('Asia/Kuala_Lumpur');

//start session
session_start();

$script_tz = date_default_timezone_get();

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'\backend\config.php'); 
include(__ROOT__.'\backend\classes\PHPMailer.php'); 
include(__ROOT__.'\backend\classes\Exception.php'); 
include(__ROOT__.'\backend\classes\SMTP.php'); 


spl_autoload_register(function($class){
    require_once(__ROOT__."/backend/classes/$class.php"); 
});
//Declare instance

$account= new Account;
$loadFromUser = new User;
$verify = new Verify;
$loadFromPosts = new Posts;
// $postsControl = new PostsControls;
$loadFromProfile = new Profile;
$loadFromFriend = new Friend;
$loadFromMessage = new Message;
$loadFromGroup = new Group;
$admin = new Admin;
$announce = new Announcement;
$loadFromGroupMessage = new GroupMessage;

require_once(__ROOT__.'\backend\shared\functions.php'); 
// require_once(__ROOT__.'\backend\shared\header.php');






