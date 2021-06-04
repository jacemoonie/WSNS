<?php

function h($string=""){
    return htmlspecialchars($string);
}

//FORM VALIDATION
function is_post_request(){
    return $_SERVER['REQUEST_METHOD']==="POST";
}

function is_get_request(){
    return $_SERVER['REQUEST_METHOD']==="GET";
}

function url_for($script){
    return WWW_ROOT.$script;
}

function redirect_to($location){
    header("Location:".$location);
    exit;
}

function log_out_user(){
    unset($_SESSION['userLoggedIn']);
    session_destroy();
    return true;
}

function log_out_admin(){
    unset($_SESSION['adminLoggedIn']);
    session_destroy();
    return true;
}

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}


?>