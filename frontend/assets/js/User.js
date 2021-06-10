$(function(){
 
    //DELETE USER
    $(document).on("click","#delete-user",function(){
        let userId = $(this).data('uid');
        $("#messagePromptModal").modal("show");
        // alert(userId);
        $(document).on("click","#confirmDelete",function(){
            $.post("http://localhost/WSNS/backend/ajax/deleteUser.php",{userId:userId},function(data){   
                    console.log(data);
                    // window.location.reload(true);
            })
        }) 
    })

    //EDIT USER
    $(document).on("click","#edit-user",function(){
    //    alert("IMPRESSED");
        let user_id = $(this).data('uid');
       

        //fetch user data
        $.post("http://localhost/WSNS/backend/ajax/fetchData.php",{user_id:user_id},function(data){   
            // alert(data);
            let userData = JSON.parse(data);
            document.getElementById("editprofilePic").src = userData.profileImage;
            $("#edit-firstName").val(userData.firstName);
            $("#edit-lastName").val(userData.lastName);
            $("#edit-email").val(userData.email);
            $("#edit-email").val(userData.email);
            $("#euser_id").val(userData.user_id);
            //  $(".announcement-list").html(data);
        })
        

    })


    //USERS REPORT TO PDF
    var downloadPDF = function() {
        DocRaptor.createAndDownloadDoc("YOUR_API_KEY_HERE", {
          test: true, // test documents are free, but watermarked
          type: "pdf",
          name: 'Welink Users list',
          document_content: document.getElementById("container").innerHTML, // use this page's HTML
          // document_content: "<h1>Hello world!</h1>",               // or supply HTML directly
          // document_url: "http://example.com/your-page",            // or use a URL
          // javascript: true,                                        // enable JavaScript processing
          prince_options: {
            baseurl: "http://localhost/WSNS/",
            media: print,                                       // use screen styles instead of print styles
          }
        })
    }
    
    document.querySelector('#pdf-button').addEventListener('click', downloadPDF);
        
})