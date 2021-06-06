<?php
if(is_post_request()){

    if(isset($_POST['euser_id'])){
        $user_id = $_POST['euser_id'];
        $user = $loadFromUser->userData($user_id);

            //check if form field is empty or not
        if(isset($_POST['efirstName']) && !empty($_POST['efirstName'])){

            $fname = FormSanitizer::formSanitizerName($_POST['efirstName']);

            if(isset($_POST['elastName']) && !empty($_POST['elastName'])){
                $lname = FormSanitizer::formSanitizerName($_POST['elastName']);
                $username=strtolower($fname."".$lname);
                if($username !== $user->username){
                    //generate new username
                    $username = $account->generateUsername($fname,$lname);
                }
                
            }
            
        }

        if(isset($_POST['eemail']) && !empty($_POST['eemail'])){

            $email = FormSanitizer::formSanitizerString($_POST['eemail']);
            if($user->email == $email){
                $email = FormSanitizer::formSanitizerString($user->email);
            }

        }

        if(isset($_POST['epassword']) && !empty($_POST['epassword'])){
            
            $password = FormSanitizer::formSanitizerString($_POST['epassword']);
            
            if(isset($_POST['epassword2']) && !empty($_POST['epassword2'])){
            
                $password2 = FormSanitizer::formSanitizerString($_POST['epassword2']);
                
            }
            
        }else{
            $password = "";
            $password2 = "";
        }

        //upload file picture
        if(isset($_FILES['editfileToUpload']) && $_FILES['editfileToUpload']['size'] !== 0){
            $newfilename = "userProfilePic".$user_id;
            $errors= array();
            $file_name = $_FILES['editfileToUpload']['name'];
            $file_size =$_FILES['editfileToUpload']['size'];
            $file_tmp =$_FILES['editfileToUpload']['tmp_name'];
            $file_type=$_FILES['editfileToUpload']['type'];
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

        // echo $user_id;
        // echo $fname;
        // echo $lname;
        // echo $username;
        // echo $email;
        // echo $password;
        // echo $password2;
        // echo $linkImage;

        // Update User
        $updateProfile = $account->updateProfile($user_id,$fname,$lname,$username,$email,$password,$password2,$linkImage);

        if(!$updateProfile)
        {
            //if failed to update
            echo '
            <script>
            $(document).ready(function() {
            $("#editUserModal").modal("show");
            });

            </script>';
        }
    }

}


?>