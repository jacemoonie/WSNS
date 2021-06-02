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

    //if user click remove
    $(document).on("click","#remove-pic",function(){
        document.getElementById('fileToUpload').value= null;
     })

   
})

