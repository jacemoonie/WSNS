$(function(){
    // var modal = document.querySelector(".d-wrapper-container");
    // var deleteModal = document.querySelector(".del-post-wrapper-container");
 
    //if user click delete button fetch the data
    $(document).on("click","#delete-post-btn",function(){
        $postID = $(this).data('post');
        $postBy = $(this).data('postby');
        $userId = $(this).data('user');
    })

    //If user click confirm to delete
    $(document).on("click","#confirmDelete",function(){
        $.post("http://localhost/WSNS/backend/ajax/deletePost.php",{postId:$postID,userId:$userId,postBy:$postBy},function(data){   
                // alert(data);
                $(".postContainer").html(data);
                location.reload(true);
        })
    }) 
    
})