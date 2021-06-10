let uid=$(".u-p-id").data("uid");
//add active class to navbar
$(function(){
   
    let path=window.location.href;
    $('.sidenav a').each(function(){
        if(this.href===path){
            $(this).addClass('active');
        }
    })
});
 
//Post
$(document).on("keydown","#postTextarea",function(event){

    if(event.keyCode === 13){
        event.preventDefault();
        let textValue=$("#postTextarea").val();
        let userid=uid;
        var statusPost = document.getElementById("friendOnlyPrivacy").checked;
        if(statusPost == true){
            $privacy = 1;
        }else{
            $privacy = 0;
        } 
        
        if(textValue != "" && textValue != null){
            console.log($privacy);
            $.post("http://localhost/WSNS/backend/ajax/post.php",{onlyStatusText:textValue,userid:userid,privacy:$privacy},function(data){
                console.log(data);   
                $(".postContainer").html(data);
                $("#postTextarea").val("");
            })
        }else{
            $("#postTextareaErrorMsg").modal("show");
        }
    }

})
$("#submitPostButton").click(e=>{
    event.preventDefault();
    let textValue=$("#postTextarea").val();
    let userid=uid;
    var statusPost = document.getElementById("friendOnlyPrivacy").checked;
    if(statusPost == true){
        $privacy = 1;
    }else{
        $privacy = 0;
    } 
    
    if(textValue != "" && textValue != null){

        $.post("http://localhost/WSNS/backend/ajax/post.php",{onlyStatusText:textValue,userid:userid,privacy:$privacy},function(data){
            console.log(data);   
            $(".postContainer").html(data);
            $("#postTextarea").val("");
        })
    }else{
        $("#postTextareaErrorMsg").modal("show");
    }
    
})

//End post

//popover
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
