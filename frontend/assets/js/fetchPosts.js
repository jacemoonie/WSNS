$(function(){
    let uid = $(".u-p-id").data("uid");
    let pid = $(".u-p-id").data("pid");
    let un = $(".u-p-id").data("un");
    let profileun = $(".u-p-id").data("profileun");
    let win = $(window);
    let offset = 10;

    win.scroll(function(){
        let content_height = $(document).height();
        let content_y = win.height()+win.scrollTop();
        // console.log(content_y + "/"+content_height);

        if(content_y >= content_height-1){
            offset += 10;
            
            if(window.location.href ==="http://localhost/WSNS/profile" || window.location.href ==="http://localhost/WSNS/"+un || window.location.href ==="http://localhost/WSNS/"+ profileun){
                $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostsProfile:offset,profileId:pid,userId:uid},function(data){      
                    $(".postContainer").html(data);
               
                })
            }  

            if(window.location.href ==="http://localhost/WSNS/home"){
                $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPosts:offset,userId:uid},function(data){   
                    $(".postContainer").html(data);
                })
            }
        }
           
    })

    $(document).ready(function(){
    
        $('#myDIV').bind('scroll',chk_scroll);
    });
    
    function chk_scroll(e)
    {
        var elem = $(e.currentTarget);
        offset += 10;
        let content_height =elem.outerHeight();
        let content_y = elem[0].scrollHeight - elem.scrollTop();

        console.log(content_y + "/"+content_height);

        if ( content_y <= content_height +1)
        {
            // console.log("Bottom");
            $.post("http://localhost/WSNS/backend/ajax/fetchPosts.php",{fetchPostsAdmin:offset},function(data){   
                $(".postContainer").html(data);
            })
        }
    
    }
    
})