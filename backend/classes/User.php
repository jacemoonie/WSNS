<?php

class User{
    private $pdo;
    private $usersOnline=array();

    public function __construct(){
        $this->pdo=Database::instance();
    }

    public function userData($user_id){
        $stmt=$this->pdo->prepare("SELECT * FROM users WHERE user_id=:userId");
        $stmt->bindParam(":userId",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $user= $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $user;
        }else{
            return false;
        }
    }

    public function userOnline(){

        $userStatus = 1;
        $stmt=$this->pdo->prepare("SELECT * FROM `users` WHERE `userStatus`=:userStatus");
        $stmt->bindParam(":userStatus",$userStatus,PDO::PARAM_INT);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $user= $stmt->fetch(PDO::FETCH_OBJ);
        if($stmt->rowCount() !=0){
            return $online = $stmt->rowCount();
        }else{
            return $online = 0;
        }
    }

    //SEARCH USER
    public function search($search){
        $stmt=$this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `username` LIKE ? OR `firstName` LIKE ? OR `lastName` LIKE ?");
        $stmt->bindValue(1,$search.'%',PDO::PARAM_STR);
        $stmt->bindValue(2,$search.'%',PDO::PARAM_STR);
        $stmt->bindValue(3,$search.'%',PDO::PARAM_STR);
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        return $stmt->fetchAll(PDO::FETCH_OBJ);
        
    }

    public function create($table, array $data)
    {

        /*
        * Check for input errors.
        */
        if(empty($data)) {
            throw new InvalidArgumentException('Cannot insert an empty array.');
        }
        if(!is_string($table)) {
            throw new InvalidArgumentException('Table name must be a string.');
        }

        $fields = '`' . implode('`, `', array_keys($data)) . '`';
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ($fields) VALUES ({$placeholders})";

        // var_dump($sql);

        // Prepare new statement
        $stmt = $this->pdo->prepare($sql);

        /*
        * Bind parameters into the query.
        *
        * We need to pass the value by reference as the PDO::bindParam method uses
        * that same reference.
        */
        foreach($data as $placeholder => &$value) {

            // Prefix the placeholder with the identifier
            $placeholder = ':' . $placeholder;

            // Bind the parameter.
            $stmt->bindParam($placeholder, $value);

        }

        /*
        * Check if the query was executed. This does not check if any data was actually
        * inserted as MySQL can be set to discard errors silently.
        */
        if(!$stmt->execute()) {
            throw new ErrorException('Could not execute query');
        }

        /*
        * Check if any rows was actually inserted.
        */
        if($stmt->rowCount() == 0) {

            var_dump($this->pdo->errorCode());

            throw new ErrorException('Could not insert data into verification table.');
            return false;
        }

        return $this->pdo->lastInsertId();

    }

    public function allUserData(){
        $stmt=$this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($users as $user){
            echo '
        <tr>
            <td>'.$user->user_id.'</td>
            <td class="user-image"><a href="#"><img src="'.$user->profileImage.'" class="avatar" alt="Avatar">'.$user->firstName.' '.$user->lastName.'</a></td>
            <td>@'.$user->username.'</td>  
            <td>'.$user->signUpDate.'</td>                       
            '.(($user->userStatus ==1) ? 
            '<td class ="status"><span>Online</span><span class="green-dot"></span></td>' : '').'
            '.(($user->userStatus ==0) ? 
            '<td class ="status"><span>Offline</span><span class="red-dot"></span></td>' : '').'
             <td>
                <button id="edit-user" data-uid="'.$user->user_id.'" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</button>
            </td>
        </tr>';

        }
       
    }

    public function allUserDataTable(){
        $stmt=$this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        // echo "<pre>";
        // $stmt->debugDumpParams();
        // echo "<pre>";
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach($users as $user){
            echo '
            <tr class="first black">
                <td>'.$user->user_id.'</td>
                <td>'.$user->firstName.' '.$user->lastName.'</td>
                <td>@'.$user->username.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->signUpDate.'</td>
            </tr>';

        }
       
    }


    public function get($tableName,$columnName, array $fields)
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
                $columns .= " AND ";
            }
            $i++;
        }
        // $sql = 'SELECT * FROM verification WHERE code = :code';
        $sql = "SELECT {$columnName} FROM {$tableName} WHERE {$columns}";
        //$sql = "SELECT {$columnName} FROM {$tableName} WHERE {$columns}";

        //$sql = "INSERT INTO {$table} ($fields) VALUES ({$placeholders})";

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

        return $stmt->fetch(PDO::FETCH_OBJ);
        

    }

    public function update($tableName,$user_id, array $fields)
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
        $sql = "UPDATE {$tableName} SET {$columns} WHERE user_id={$user_id} ";
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

    public function delete($tableName, array $fields)
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


        $sql = "DELETE FROM {$tableName}";
        $where =" WHERE ";
        // $sql = "UPDATE {$tableName} SET {$columns} WHERE user_id={$user_id} ";
        // $sql = "SELECT {$columnName} FROM {$tableName} WHERE {$columns}";
        foreach($fields as $key => &$value) {

            $sql .= "{$where} {$key} =:{$key}";
            $where = " AND ";

        }

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
            return false;
        }else{
            return true;
        }
    
    }

    public function userIdByUsername($username){
        $user = $this->get("users","user_id",array("username" => $username));
        return $user->user_id;
    }

    public function timeAgo($datetime){
        $time = strtotime($datetime);
        $current = time();
        $seconds = $current - $time;
        $minutes = round($seconds/60);
        $hours = round($seconds/3600);
        $months = round($seconds/2600240);

        if($seconds <= 60){
            if($seconds == 0){
                return 'Just now';
            }else{
                return ''.$seconds.'s';
            }
        }else if($minutes <= 60){
            return ''.$minutes.'m ago';
        }else if($hours <= 24){
            return ''.$hours.'h ago';
        }else if($months <= 24){
            return ''.date('M j', $time);
        }else{
            return ''.date('j M Y', $time);
        }
    }

   
    

}

?>