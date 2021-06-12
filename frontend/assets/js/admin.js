$(function(){
    //if user click friend-only button fetch the data
    $(document).on("click",".show-posts-tab",function(e){
        e.preventDefault();
        $(".show-event-only").removeClass("active");
        $(".show-posts-tab").addClass("active");
        $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostsAdmin:uid},function(data){   
            $(".postContainer").html(data);
        })
        
    })

    $(document).on("click",".show-event-only",function(e){
        e.preventDefault();
        $(".show-event-only").addClass("active");
        $(".show-posts-tab").removeClass("active");
        $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchEvent:uid},function(data){   
            $(".postContainer").html(data);
        })
    })
       
})