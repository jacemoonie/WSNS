<?php

class Profile{
    private $pdo;
    private $user;
    private $errorArray=array();

    //connect database
    public function __construct(){
        $this->pdo = Database::instance();
        $this->user = new User;
    }

    //Profile Button friend/setup
    
    
}
