var timer;
$(function(){

    //ADD FRIEND USER SEARCH
    $(document).on("keydown","#s-add-friend",function(e){
        clearTimeout(timer);
        var textbox = $(e.target);

        timer = setTimeout(()=>{
            $search = textbox.val().trim();
            if($search !=""){
                // console.log("Containe data");
                $.post("http://localhost/WSNS/backend/ajax/searchUser.php",{searchUser:$search,userId:uid},function(data){      
                    
                    $("#s-result-user").html(data);
                    // console.log(data);
                })
            }else{
                $("#s-result-user").html("");
            }
        },500);
    })

    $(document).on("click","#add-friend",function(e){
        $("#sendFriendRequest").modal("show");
        $("#s-result-user").html("");
        $("#s-add-friend").html("");
    })

   
})

