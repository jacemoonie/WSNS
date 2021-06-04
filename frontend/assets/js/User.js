$(function(){
 
    //DELETE USER
    $(document).on("click","#del-announce",function(){
        let annID = $(this).data('auid');
        $("#messagePromptModal").modal("show");
        $(document).on("click","#confirmDelete",function(){
            $.post("http://localhost/WSNS/backend/ajax/deleteAnnouncement.php",{annID:annID},function(data){   
                    // alert(data);
                    $(".announcement-list").html(data);
            })
        }) 
    })

    //EDIT USER
    $(document).on("click","#edit-user",function(){
    //    alert("IMPRESSED");
        let user_id = $(this).data('uid');
       

        //fetch user data
        $.post("http://localhost/WSNS/backend/ajax/fetchData.php",{user_id:user_id},function(data){   
            // alert(data);
            let userData = JSON.parse(data);
            document.getElementById("editprofilePic").src = userData.profileImage;
            $("#edit-firstName").val(userData.firstName);
            $("#edit-lastName").val(userData.lastName);
            $("#edit-email").val(userData.email);
            $("#edit-email").val(userData.email);
            $("#user_id").val(userData.user_id);
            //  $(".announcement-list").html(data);
        })
        

    })
    
})