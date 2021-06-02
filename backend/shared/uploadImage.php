<?php
   $newfilename = "newfilename";

   if(isset($_FILES['fileToUpload'])){
      $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size =$_FILES['fileToUpload']['size'];
      $file_tmp =$_FILES['fileToUpload']['tmp_name'];
      $file_type=$_FILES['fileToUpload']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));

      $expensions= array("jpeg","jpg","png");
      if(file_exists($file_name)) {
        echo "Sorry, file already exists.";
        }
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }

      if(empty($errors)==true){
        move_uploaded_file($file_tmp,"frontend/profileImage/".$newfilename.".".$file_ext);
        echo "Success";
        echo "<script>window.close();</script>";

      }

      else{
         print_r($errors);
      }
   }
?>