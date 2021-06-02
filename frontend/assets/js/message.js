var timer;
$(function(){

    //NEW MESSAGE SEARCH
    $(document).on("keydown",".s-user",function(e){
        
        clearTimeout(timer);
        var textbox = $(e.target);

        timer = setTimeout(()=>{
            $search = textbox.val().trim();
            if($search !=""){
                // console.log("Containe data");
                $.post("http://localhost/WSNS/backend/ajax/searchMessage.php",{searchMessage:$search,userId:uid},function(data){      
                    
                    $(".s-result-user").html(data);
                    // alert(data);
                })
            }else{
                $(".s-result-user").html("");
            }
        },500);
    })

    //REDIRECT TO MESSAGE PAGE
    $(document).on("click",".h-ment",function(e){
        var profileId = $(this).data("profileid");
        if(profileId !="" && profileId != undefined){
            window.location.href = "http://localhost/WSNS/messages/"+profileId;
        }
    })
    
   
})

