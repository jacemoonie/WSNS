// let uid=$(".u-p-id").data("uid");
var cropper;
$(function(){
    
    //If user click upload picture
    $(document).on("change","#eventfileToUpload",function(){
        const [file] = eventfileToUpload.files
        if (file) {
            eventprofilePic.src = URL.createObjectURL(file)
        }
    })

     //if user click remove
    $(document).on("click","#eventremove-pic",function(){
        document.getElementById('eventfileToUpload').value= null;
        
     })

     //If user click upload picture
    $(document).on("change","#editeventfileToUpload",function(){
        const [file] = editeventfileToUpload.files
        if (file) {
            editeventprofilePic.src = URL.createObjectURL(file)
        }
    })

     //if user click remove
    $(document).on("click","#editeventremove-pic",function(){
        document.getElementById('editeventfileToUpload').value= null;
        
     })

      //if user click remove
    $(document).on("click","svg#delete-event",function(){
        $eventid = $(this).data("eventid");
        $uid = $("u-p-id").data("uid");
        
        $("#messagePromptModal").modal("show");
        console.log($eventid);

        $(document).on("click","#confirmDelete",function(){
        
            $.post("http://localhost/WSNS/backend/ajax/deleteEvents.php",{eventID:$eventid,userid:$uid},function(data){   
                $("#eventDelete").modal("show");
                var loadTimer = setInterval(() => {
                    window.location.href = "http://localhost/WSNS/events";
                }, 3000);
            })
            
        })
        
     })

   
})

