<?php

define("DB_HOST","localhost");
define("DB_NAME","welink");
define("DB_USER","welink");
define("DB_PASS","password");

// define("BASE_URL',"https://localhost/welink/")
$public_end=strpos($_SERVER['SCRIPT_NAME'],'frontend')+6;
$doc_root=substr($_SERVER['SCRIPT_NAME'],0,$public_end);
define("WWW_ROOT",$doc_root);


//SMTP
define("M_HOST","smtp.gmail.com");
define("M_USERNAME","jacellynjustinjuis@gmail.com");
define("M_PASSWORD","ingcjoodafupzmmr");
define("M_SMTPSECURE","tls");
define("M_PORT",587);


?>