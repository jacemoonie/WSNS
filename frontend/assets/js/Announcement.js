$(function(){
 
    //DELETE ANNOUNCEMENT
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

    //EDIT ANNOUNCEMENT
    $(document).on("click","#edit-announce",function(){
    //    alert("IMPRESSED");
        let annID = $(this).data('auid');
        $(".ann_id").val(annID);

        //fetch announce data
        $.post("http://localhost/WSNS/backend/ajax/fetchAnnouncement.php",{annID:annID},function(data){   
            $("#edit-description").val(data);
            //  $(".announcement-list").html(data);
        })
        

    })
    
})