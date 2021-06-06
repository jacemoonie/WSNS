function showPassword(){
    
    let password= document.getElementById("password");
    let password2= document.getElementById("password2");
    
    if(password.type==="password" || password2.type==="password"){
        password.type="text";
        password2.type="text";
    }
    else{
        password.type="password";
        password2.type="password";
    }
}

function showLoginPassword(){
    let password= document.getElementById("password");
    
    if(password.type==="password"){
        password.type="text";

    }
    else{
        password.type="password";

    }
}
$(function(){
    
    $(document).on("click","#s-password",function(){

        let password= document.getElementById("password1");
        let password2= document.getElementById("password2");
        
        if(password.type==="password" || password2.type==="password"){
            
            password1.type="text";
            password2.type="text";

        }else{
            password1.type="password";
            password2.type="password";
        }

    })

    
})