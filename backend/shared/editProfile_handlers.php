<?php 
if(is_post_request()){
  
    $user_id = $_POST['user_id'];
    $profileId = $user_id;
    $user = $loadFromUser->userData($user_id);

//upload file picture
if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['size'] !== 0){
    $newfilename = "userProfilePic".$user_id;
    $errors= array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size =$_FILES['fileToUpload']['size'];
    $file_tmp =$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = strtolower(end($tmp));

    $expensions= array("jpeg","jpg","png");
    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
    }

    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"frontend/profileImage/".$newfilename.".".$file_ext);
        $linkImage = "frontend/profileImage/".$newfilename.".".$file_ext;
        
    }

    else{
       print_r($errors);
    }
 }
 else{
     $linkImage = $user->profileImage;
 }

if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
    $user_id = $_POST['user_id'];
    $user = $loadFromUser->userData($user_id);

    //check if form field is empty or not
    if(isset($_POST['firstName']) && !empty($_POST['firstName'])){

        $fname = FormSanitizer::formSanitizerName($_POST['firstName']);

        if(isset($_POST['lastName']) && !empty($_POST['lastName'])){
            $lname = FormSanitizer::formSanitizerName($_POST['lastName']);
            //generate new username
            $username = $account->generateUsername($fname,$lname);
            
        }
        
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){

        $email = FormSanitizer::formSanitizerString($_POST['email']);

    }

    if(isset($_POST['password']) && !empty($_POST['password'])){
        
        $password = FormSanitizer::formSanitizerString($_POST['password']);
        
        if(isset($_POST['password2']) && !empty($_POST['password2'])){
        
            $password2 = FormSanitizer::formSanitizerString($_POST['password2']);
            
        }
        
    }else{
        $password = "";
        $password2 = "";
    }

    $updateProfile = $account->updateProfile($user_id,$fname,$lname,$username,$email,$password,$password2,$linkImage);

    if(!$updateProfile){
        //if failed to update
        echo '
        <script>
        $(document).ready(function() {
          $("#editProfileModal").modal("show");
        });
        
        </script>';
    }
}

}

?>
