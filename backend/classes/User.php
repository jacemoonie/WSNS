<?php

class User{
    private $pdo;

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
        }

        return $this->pdo->lastInsertId();

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

    public function cropProfileImageUpload($file,$user_id){
        $fileInfo = getImageSize($file['tmp_name']);
        // var_dump($fileInfo);
        $fileTmp = $file['tmp_name'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $ext = explode('/',$fileType);
        $ext = strtolower(end($ext));
        // var_dump($ext);
        $allowed = array('image/png','image/jpeg','image/jpg');
       
        if(in_array($fileInfo['mime'],$allowed)){
            $path_directory = $_SERVER['DOCUMENT_ROOT']."/welink/frontend/profileImage/".$userId."/";
            if(!file_exists($path_directory) && !is_dir($path_directory)){
                mkdir($path_directory,0777,true);
            }
            $folder = "frontend/profileImage/".$userId."/".substr(md5(time().mt_rand()),2,25).".".$ext;
            $path_files = $_SERVER['DOCUMENT_ROOT']."/welink/".$folder;
            if($fileError === 0){
                move_uploaded_file($fileTmp,$path_files);
                 return $folder;
            }
        }
        
    }

    public function cropCoverImageUpload($file,$user_id){
        $fileInfo = getImageSize($file['tmp_name']);
        // var_dump($fileInfo);
        $fileTmp = $file['tmp_name'];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $ext = explode('/',$fileType);
        $ext = strtolower(end($ext));
        // var_dump($ext);
        $allowed = array('image/png','image/jpeg','image/jpg');
       
        if(in_array($fileInfo['mime'],$allowed)){
            $path_directory = $_SERVER['DOCUMENT_ROOT']."/welink/frontend/profileCover/".$userId."/";
            if(!file_exists($path_directory) && !is_dir($path_directory)){
                mkdir($path_directory,0777,true);
            }
            $folder = "frontend/profileCover/".$userId."/".substr(md5(time().mt_rand()),2,25).".".$ext;
            $path_files = $_SERVER['DOCUMENT_ROOT']."/welink/".$folder;
            if($fileError === 0){
                move_uploaded_file($fileTmp,$path_files);
                 return $folder;
            }
        }
        
    }

}

?>