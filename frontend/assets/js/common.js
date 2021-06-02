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
$("#submitPostButton").click(e=>{
    e.preventDefault();
    let submitButton=$("#submitPostButton");
    let textValue=$("#postTextarea").val();
    let userid=uid;
    
    if(textValue != "" && textValue != null){
        
        $.post("http://localhost/WSNS/backend/ajax/post.php",{onlyStatusText:textValue,userid:userid},function(data){
            $(".postContainer").html(data);
            $("#postTextarea").val("");
        })
    }
    
})

//End post

//popover
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
