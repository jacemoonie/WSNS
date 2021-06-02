<?php

class Account{
    private $pdo;
    private $user;
    private $errorArray=array();

    //connect database
    public function __construct(){
        $this->pdo = Database::instance();
        $this->user = new User;
    }

    //register user
    public function register($fn,$ln,$un,$em,$pw,$pw2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateEmail($em);
        $this->validatePassword($pw,$pw2);
        if(empty($this->errorArray)){
            return $this->insertUserDetails($fn,$ln,$un,$em,$pw);
        }
        else{
            return false;
        }
    }

      //register user
    public function updateProfile($uid,$fn,$ln,$un,$em,$npw,$npw2,$linkImage){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $user = $this->user->userData($uid);
        if($user->email !== $em)
        {
            $this->validateEmail($em);
        }
        if(!empty($npw) && !empty($npw2)){

            $this->validatePassword($npw,$npw2);
        }
        if(empty($this->errorArray)){
            
            return $this->updateUserDetails($uid,$fn,$ln,$un,$em,$npw,$linkImage);
        }
        else{
            return false;
        }
    }
    

    //login user
    public function login($username,$pass){
    
        //check username
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username =:un OR email =:un');
        $stmt->bindParam(":un",$username,PDO::PARAM_STR);
        
        if(!$stmt->execute()) {
            throw new ErrorException('Could not execute query');
        }
        
        $count = $stmt->rowCount();
        if($count != 0){
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $pass_hash = $user->password;
            //compare pass
            if(password_verify($pass,$pass_hash)){
                return $user->user_id;
            }else{
                array_push($this->errorArray,Constants::$loginPasswordWrong);
                return false;
            }
            
        }else{
            array_push($this->errorArray,Constants::$loginUsernameEmailWrong);
                return false;
        }
        
    }

    private function validateFirstName($fn){
        
        if($this->length($fn,2,25)){
            array_push($this->errorArray,Constants::$firstNameCharacters);
            return;
        }
    }

    private function validateLastName($ln){
        
        if($this->length($ln,2,25)){
            array_push($this->errorArray,Constants::$lastNameCharacters);
            return;
        }
    }

    private function validatePassword($pw,$pw2){
        if($pw != $pw2){
            array_push($this->errorArray,Constants::$passwordDoNotMatch);
            return;
        }
        if($this->length($pw,5,25)){
            array_push($this->errorArray,Constants::$passwordTooShort);
            return;
        }
        if($this->length($pw2,5,25)){
            array_push($this->errorArray,Constants::$passwordTooShort);
            return;
        }
        if(preg_match("/[^A-Za-z0-9]/",$pw)){
            array_push($this->errorArray,Constants::$passwordAlphaNumeric);
            return;
        }
    }
    public function generateUsername($fn,$ln){
        if(!empty($fn) && !empty($ln)){
            if(!in_array(Constants::$firstNameCharacters,$this->errorArray) && !in_array(Constants::$lastNameCharacters,$this->errorArray)){
                $username=strtolower($fn."".$ln);
                if($this->checkUsernameExist($username)){
                    $screenRand=rand();
                    $userLink=''.$username.''.$screenRand;
                }else{
                    $userLink=$username;
                }
                return $userLink;
            }
        }
    }

    private function getHashPassword($un){
        $stmt = $this->pdo->prepare('SELECT password FROM users WHERE username =:un OR email =:un');
        $stmt->bindParam(":un",$un,PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $count=$stmt->rowCount();
        if($count > 0){
            return $user->password;
        }else{
            return false;
        }
    }

    private function checkUsernameExist($username){
        $stmt=$this->pdo->prepare("SELECT username FROM users WHERE username=:username");
        $stmt->bindParam(":username",$username,PDO::PARAM_STR);
        $stmt->execute();
        $count=$stmt->rowCount();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    private function validateEmail($em){
        $stmt=$this->pdo->prepare("SELECT email FROM users WHERE email=:email");
        $stmt->bindParam(":email",$em,PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() !=0){
            array_push($this->errorArray,Constants::$emailTaken);
            return;
        }

        if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
            array_push($this->errorArray,Constants::$emailInvalid);
            return;
        }
    }

    private function insertUserDetails($fn,$ln,$un,$em,$pw){
        $pass_hash=password_hash($pw,PASSWORD_BCRYPT);
        $rand=rand(0,2);
        if($rand==0){
            $profilePic="frontend\assets\images\defaultProfilePic.png";
            $profileCover="frontend\assets\images\backgroundCoverPic.svg";
        }else if($rand==1){
            $profilePic="frontend\assets\images\defaultPic.svg";
            $profileCover="frontend\assets\images\backgroundImage.svg";
        }elseif($rand==2){
            $profilePic="frontend\assets\images\profilePic.jpeg";
            $profileCover="frontend\assets\images\backgroundCoverPic.svg";
        }

        $stmt=$this->pdo->prepare("INSERT INTO users (firstName,lastName,username,email,password,profileImage,profileCover) VALUES (:fn,:ln,:un,:em,:pw,:pic,:cov)");
        $stmt->bindParam(":fn",$fn,PDO::PARAM_STR);
        $stmt->bindParam(":ln",$ln,PDO::PARAM_STR);
        $stmt->bindParam(":un",$un,PDO::PARAM_STR);
        $stmt->bindParam(":em",$em,PDO::PARAM_STR);
        $stmt->bindParam(":pw",$pass_hash,PDO::PARAM_STR);
        $stmt->bindParam(":pic",$profilePic,PDO::PARAM_STR);
        $stmt->bindParam(":cov",$profileCover,PDO::PARAM_STR);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }

    private function updateUserDetails($uid,$fn,$ln,$un,$em,$pw,$linkImage){
        
        if(!empty($fn)){
            $stmt = $this->user->update("users",$uid,["firstName" =>$fn]);
        }
        if(!empty($ln)){
            $stmt = $this->user->update("users",$uid,["lastName" =>$ln]);
        }
        if(!empty($un)){
            $stmt = $this->user->update("users",$uid,["username" =>$un]);
        }
        if(!empty($em)){
            $stmt = $this->user->update("users",$uid,["email" =>$em]);
        }
        if(!empty($pw)){
            $npw = password_hash($pw,PASSWORD_BCRYPT);
            $stmt = $this->user->update("users",$uid,["password" =>$npw]);
        }
        if(!empty($linkImage)){
            $npw = password_hash($pw,PASSWORD_BCRYPT);
            $stmt = $this->user->update("users",$uid,["profileImage" =>$linkImage]);
        }

        return true;
    }

    private function length($input,$min,$max){
        if(strlen($input) < $min){
            return true;
        } elseif(strlen($input) > $max){
            return true;
        }
    }
    public function getError($error){
        if(in_array($error,$this->errorArray)){
            return "<span class='errorMessage'>$error</span>";
        }
    }
}