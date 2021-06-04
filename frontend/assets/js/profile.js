// let uid=$(".u-p-id").data("uid");
var cropper;
$(function(){
    
    //If user click upload picture
    $(document).on("change","#fileToUpload",function(){
        const [file] = fileToUpload.files
        if (file) {
            profilePic.src = URL.createObjectURL(file)
        }
    })

    //If user click upload picture
    $(document).on("change","#editfileToUpload",function(){
        const [file] = editfileToUpload.files
        if (file) {
            editprofilePic.src = URL.createObjectURL(file)
        }
    })

    //if user click remove
    $(document).on("click","#remove-pic",function(){
        document.getElementById('fileToUpload').value= null;
     })

     //if user click remove
    $(document).on("click","#editremove-pic",function(){
        document.getElementById('editfileToUpload').value= null;
     })

   
})

