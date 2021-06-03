var timer;
$(function(){

    //NEW MESSAGE SEARCH
    $(document).on("keydown",".s-member",function(e){
        
        clearTimeout(timer);
        var textbox = $(e.target);

        timer = setTimeout(()=>{
            $search = textbox.val().trim();
            if($search !=""){
                // console.log("Containe data");
                $.post("http://localhost/WSNS/backend/ajax/searchGroupMessage.php",{searchMessage:$search,userId:uid},function(data){      
                    
                    $(".s-result-user").html(data);
                    // alert(data);
                })
            }else{
                $(".s-result-user").html("");
            }
        },500);
    })

    //Create Group
    $(document).on("click","#createGroup-submit",function(e){
        
        let groupCreatedBy = $(this).data('uid');
        let groupName = document.getElementsByName('groupName');
        let groupDescription = document.getElementsByName('groupDescription');

        alert(groupCreatedBy);
        // //transfer data
        // if(groupCreatedBy !="" && groupCreatedBy !=undefined){
        //     $.post("http://localhost/WSNS/backend/ajax/groupMessage.php",{groupCreatedBy:groupCreatedBy,groupName:groupName,groupDescription:groupDescription},function(data){      
                    
        //             // $(".s-result-user").html(data);
        //             alert(data);
        //     })
        // }
    })

   
})

