<?php
class Message{
    
    protected $pdo;
    protected $user;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user= new User;
        
    }

    public function recentMessage($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom`=`user_id` AND `messageID` IN (SELECT max(`messageID`) FROM `messages` WHERE `messageFrom`=`user_id`) WHERE `messageTo`=:user_id AND `messageFrom`=`user_id` GROUP BY `user_id` ORDER BY `messageID` DESC");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}