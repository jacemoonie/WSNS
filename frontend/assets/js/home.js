$(function(){
    //if user click friend-only button fetch the data
    $(document).on("click",".show-friend-only",function(e){
        e.preventDefault();
        $(".show-all-tab").removeClass("active");
        $(".show-friend-only").addClass("active");
        $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostFriend:uid},function(data){   
            $(".postContainer").html(data);
        })
        
    })

    $(document).on("click",".show-all-tab",function(e){
        e.preventDefault();
        $(".show-all-tab").addClass("active");
        $(".show-friend-only").removeClass("active");
        $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostAll:uid},function(data){   
            $(".postContainer").html(data);
        })
    })
       
})