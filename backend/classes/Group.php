<?php
class Group{
    
    protected $pdo;
    protected $user;
    protected $message;

    public function __construct(){
        $this->pdo=Database::instance();
        $this->user= new User;
        $this->message = new Message;
        
    }

    //GROUP DATA
    public function groupData($groupCreatedBy,$groupName){
        $stmt=$this->pdo->prepare("SELECT * FROM `group` WHERE `groupCreatedBy`=:userId AND `groupName`=:groupName");
        $stmt->bindParam(":userId",$groupCreatedBy,PDO::PARAM_INT);
        $stmt->bindParam(":groupName",$groupName,PDO::PARAM_STR);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $group= $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $group;
        }else{
            return false;
        }
    }

    public function listGroup($user_id){
        $stmt = $this->pdo->prepare("SELECT `group_id` FROM `groupmembers` WHERE `user_id`=:user_id");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $group= $stmt->fetchAll(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $group;
        }else{
            return false;
        }
    }

    
    //GROUP DATA BY GROUPID
    public function groupDataByID($groupID){
        $stmt=$this->pdo->prepare("SELECT * FROM `group` WHERE `groupID`=:groupID");
        $stmt->bindParam(":groupID",$groupID,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $group= $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $group;
        }else{
            return false;
        }
    }
    
    //UPDATE GROUP
    public function updateGroupData($tableName,$group_id, array $fields)
    {

        /*
        * Check for input errors.
        */
        if(empty($fields)) {
            throw new InvalidArgumentException('Cannot insert an empty array.');
        }
        if(!is_string($tableName)) {
            throw new InvalidArgumentException('Table name must be a string.');
        }


        $columns="";
        $i=1;
        foreach($fields as $name => &$value){
            $columns .= "{$name} = :{$name}";
            if($i < count($fields)){
                $columns .= " , ";
            }
            $i++;
        }
        // $sql = 'SELECT * FROM verification WHERE code = :code';
        $sql = "UPDATE {$tableName} SET {$columns} WHERE `groupID`={$group_id} ";
        // $sql = "SELECT {$columnName} FROM {$tableName} WHERE {$columns}";


        // var_dump($sql);

        // Prepare new statement
        $stmt = $this->pdo->prepare($sql);

        /*
        * Bind parameters into the query.
        *
        * We need to pass the value by reference as the PDO::bindParam method uses
        * that same reference.
        */
        foreach($fields as $key => &$value) {

            // Prefix the placeholder with the identifier
            $key = ':' . $key;

            // Bind the parameter.
            $stmt->bindValue($key, $value);

        }

        /*
        * Check if the query was executed. This does not check if any data was actually
        * inserted as MySQL can be set to discard errors silently.
        */
        if(!$stmt->execute()) {
            throw new ErrorException('Could not execute query');
        }
    
    }


     //GROUP MEMBERS BY GROUPID
     public function groupMembers($groupID){
        $stmt=$this->pdo->prepare("SELECT `user_id` FROM `groupmembers` WHERE `group_id`=:groupID");
        $stmt->bindParam(":groupID",$groupID,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $group= $stmt->fetchAll(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $group;
        }else{
            return false;
        }
    }


    //RECENT GROUP CHAT
    public function recentMessage($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom`=`user_id` AND `messageID` IN (SELECT max(`messageID`) FROM `messages` WHERE `messageFrom`=`user_id`) WHERE `messageTo`=:user_id AND `messageFrom`=`user_id` GROUP BY `user_id` ORDER BY `messageID` DESC");
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //FETCH MESSAGE DATA
    public function messageData($userId,$otherid){
        $stmt = $this->pdo->prepare("SELECT * FROM `messages` LEFT JOIN `users` ON `messageFrom`=`user_id` WHERE (`messageTo`=:userID AND `messageFrom`=:otherpersonid) OR (`messageTo`=:otherpersonid AND `messageFrom`=:userID) ORDER BY `messageOn` ASC");
        $stmt->bindParam(":userID",$userId,PDO::PARAM_INT);
        $stmt->bindParam(":otherpersonid",$otherid,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}