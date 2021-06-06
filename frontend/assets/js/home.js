$(function(){

    //if user click friend-only button fetch the data
    $(document).on("click",".show-friend-only",function(){
        $userId = $(".u-p-id").data("uid");
        $(".show-all-tab").removeClass("active");
        $(".show-friend-only").addClass("active");

        $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostsHomeFriendOnly:$uid},function(data){
                console.log(data);
                // $('.postContainer').html(data);
        })
    })

    
})