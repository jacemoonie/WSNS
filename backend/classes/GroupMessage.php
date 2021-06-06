<?php
class GroupMessage{
    
    protected $pdo;
    protected $user;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user= new User;
        
    }

    public function recentMessage($groupID){
        $stmt = $this->pdo->prepare("SELECT * FROM `groupmessage` LEFT JOIN `users` ON `groupMsgFrom`=`user_id` AND `groupMessageID` IN (SELECT max(`groupMessageID`) FROM `groupmessage` WHERE `groupMsgFrom`=`user_id`) WHERE `groupMsgTo`=:groupID AND `groupMsgFrom`=`user_id` GROUP BY `user_id` ORDER BY `groupMessageID` DESC");
        $stmt->bindParam(":groupID",$groupID,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function allMessageInGroup($groupID){
        $stmt = $this->pdo->prepare("SELECT `groupMessage`, `groupMessageOn`, `groupMsgFrom` FROM `groupmessage` WHERE `groupMsgTo`=:groupID ORDER BY `groupMessageOn` ASC");
        $stmt->bindParam(":groupID",$groupID,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function messageData($userId,$otherid){
        $stmt = $this->pdo->prepare("SELECT * FROM `groupmessage` LEFT JOIN `users` ON `groupMsgFrom`=`user_id` WHERE (`groupMsgTo`=:userID AND `groupMsgFrom`=:otherpersonid) OR (`groupMsgTo`=:otherpersonid AND `groupMsgFrom`=:userID) ORDER BY `messageOn` ASC");
        $stmt->bindParam(":userID",$userId,PDO::PARAM_INT);
        $stmt->bindParam(":otherpersonid",$otherid,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}