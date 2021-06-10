var timer;
var groupParticipant = new Array();
$(function(){

    //NEW MESSAGE SEARCH
    $(document).on("keydown","#s-group-participant",function(e){
        document.getElementById("err-msg").style.display = "none";
        clearTimeout(timer);
        var textbox = $(e.target);

        timer = setTimeout(()=>{
            $search = textbox.val().trim();
            if($search !=""){
                // console.log("Containe data");
                $.post("http://localhost/WSNS/backend/ajax/searchGroupParticipant.php",{searchParticipant:$search,userId:uid},function(data){      
                    
                    $("#s-result-user").html(data);
                    // console.log(data);
                })
            }else{
                $("#s-result-user").html("");
            }
        },500);
    })

    $(document).on("click","#add-participant",function(e){
        e.preventDefault();
        $userid = $(this).data('uid');
    
        //CHECK IF UID ALREADY EXIST
        if(!groupParticipant.includes($userid)){
            groupParticipant.push($userid);
            // console.log("ID NOT EXISt");
            //SHOW THE NAME
           if($uid !=0 && $uid !=undefined){

                if($.trim( $('.participant-list').html() ).length == 0){
                    $.post("http://localhost/WSNS/backend/ajax/showParticipant.php",{showParticipant:$userid},function(data){
                        $(".participant-list").html(data);
                    })
                }else{
                    $.post("http://localhost/WSNS/backend/ajax/showParticipant.php",{showParticipant:$userid},function(data){
                        var h = document.getElementById("participant-info");
                        h.insertAdjacentHTML("afterend", data);  
                    })
                }
           }
        }else{
            // console.log("ID EXISt");
            document.getElementById("err-msg").style.display = "block";
        }
        $("#s-result-user").html("");
        // console.log(groupParticipant);     
        
    })

    $(document).on("click",".cancel-participant",function(e){
        // console.log("IMCLICCKED");
        $userid = $(this).data('uid');
        // console.log($userid);
        $(e.target).parent().remove();
        //REMOVE ID 
        const index = groupParticipant.indexOf($userid);
        if (index > -1) {
            groupParticipant.splice(index, 1);
        }
        // console.log(groupParticipant);
    })
    
    //GROUP DETAILS
    $(document).on("click",".next-group-detail",function(e){
        
        var participant = JSON.stringify(groupParticipant);
    
        $.post("http://localhost/WSNS/backend/ajax/showParticipant.php",{showMembers:participant},function(data){
            $(".selected-participant-list").html(data); 
        })
        
        e.preventDefault();
        // console.log(groupParticipant);
        $("#groupDetailModal").modal("show");
        $("#newGroupMessageModal").modal("hide");

        //USER CLICK CREATE GROUP
        $(document).on("click",".createGroup-submit",function(e){
            
            // console.log("IMCLICKED");
            //CREATE GROUP
            var groupCreatedBy = document.getElementById("groupCreatedBy").value;
            var groupName = document.getElementById("groupName").value;
            var groupDescription = document.getElementById("groupDescription").value;
            groupParticipant.push(groupCreatedBy);
            var groupMembers = JSON.stringify(groupParticipant);
            // console.log(groupCreatedBy);
            // console.log(groupName);
            // console.log(groupMembers);
            if(groupName ==""){
                document.getElementById("err-msg-gname").innerHTML = "Group name is empty";
                document.getElementById("err-msg-gname").style.display = "block";
                if(groupDescription == ""){
                    document.getElementById("err-msg-gdesc").innerHTML = "Group description is empty";
                    document.getElementById("err-msg-gdesc").style.display = "block";
                }         
            }  
            
            if(groupName!="" && groupDescription!=""){

                $.post("http://localhost/WSNS/backend/ajax/createGroup.php",{groupCreatedBy:groupCreatedBy,groupName:groupName,groupDescription:groupDescription,groupMembers:groupMembers},function(data){      
                    var groupId = data;   
                    console.log(data);
                    // //REDIRECT TO MESSAGE PAGE
                    if(groupId !="" && groupId != undefined){
                        window.location.href = "http://localhost/WSNS/group/"+groupId;
                    }  
                })
            }
            
        })

    })

    //EDIT GROUP
    $(document).on("click",".edit-group-btn",function(e){
        $groupidToEdit = $(this).data('editgroupdata');
        $userid = $(this).data('userid');

        $.post("http://localhost/WSNS/backend/ajax/showParticipant.php",{groupEditMembers:$groupidToEdit,userid:$userid},function(data){
        // console.log(data);    
        $("#group-participant-list").html(data);
        })

         //REMOVE MEMBER FROM GROUP
        $(document).on("click",".edit-remove-participant",function(e){
            console.log("IMCLICCKED");
            $userid = $(this).data('uid');
            $gid = $(this).data('gid');
            $(e.target).parent().remove();
            //REMOVE ID FROM DATABASE
            $.post("http://localhost/WSNS/backend/ajax/editGroup.php",{removeMemberid:$userid,fromGroupid:$gid},function(data){
                console.log(data);    
                // $("#group-participant-list").html(data);
            })       
        })

        //FETCH GROUP INFO
        $.post("http://localhost/WSNS/backend/ajax/fetchGroupData.php",{groupEditMembers:$groupidToEdit,userid:$userid},function(data){
            let groupData = JSON.parse(data);
            $("#edit-groupName").val(groupData.groupName);
            $("#edit-groupDescription").val(groupData.groupDescription);
            
        })

        //UPDATE DATA
        $(document).on("click",".editGroup-submit",function(e){
            // console.log("IMCLICKED");
            $groupName = document.getElementById("edit-groupName").value; 
            $groupDescription = document.getElementById("edit-groupDescription").value; 
            //UPDATE DATA 
            $.post("http://localhost/WSNS/backend/ajax/editGroup.php",{update:$groupidToEdit,userid:$userid,groupName:$groupName,groupDescription:$groupDescription},function(data){
                // console.log(data);
                window.location.reload(true);
            })
        })

        //ADD PARTICIPANT
        $(document).on("keydown","#edit-group-participant",function(e){
            document.getElementById("edit-err-msg").style.display = "none";
            // console.log("HI");
            clearTimeout(timer);
            var textbox = $(e.target);

            timer = setTimeout(()=>{
                $search = textbox.val().trim();
                if($search !=""){
                    // console.log("Containe data");
                    $.post("http://localhost/WSNS/backend/ajax/searchGroupParticipant.php",{editParticipant:$search,userId:uid},function(data){      
                        
                        $("#s-edit-result-user").html(data);
                        // console.log(data);
                    })
                }else{
                    $("#s-edit-result-user").html("");
                }
            },500);
        })

        $(document).on("click","#edit-add-participant",function(e){
            e.preventDefault();
            $addMemberID = $(this).data('uid');
            
            // console.log($addMemberID);
            //ADD MEMBER TO DATABASE
            $.post("http://localhost/WSNS/backend/ajax/editGroup.php",{addMemberid:$addMemberID,fromGroupid:$groupidToEdit},function(data){
                
                // console.log(data);
                
                if(data == 1){
                    // console.log("YES"); 
                    document.getElementById("edit-err-msg").innerHTML = "User is already a member."; 
                    document.getElementById("edit-err-msg").style.display = "block"; 
                }else{
                    // console.log("NO"); 
                    //SHOW DATA 
                    $.post("http://localhost/WSNS/backend/ajax/showParticipant.php",{groupEditMembers:$groupidToEdit,userid:$userid},function(data){
                        $("#group-participant-list").html(data);
                    })
                } 
                $("#s-edit-result-user").html("");
                
            })
        })

    })

   
})

