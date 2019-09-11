function verifUser() {
    
    

    var user = document.getElementById("user");
    

        if (user.value == "") {
            user.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else{
            
        user.style.borderColor = "#ffffff";
        return true;
            
        }

}


function verifPass(){
    
    var password = document.getElementById("password");
    
    
            if (password.value == "") {
            password.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else{
            
        password.style.borderColor = "#ffffff";
        return true;
            
        }
}







function error(){
        var user = document.getElementById("user");
    var password = document.getElementById("password");
            user.style.borderColor = "rgba(252, 107, 71, 0.78)";
            password.style.borderColor = "rgba(252, 107, 71, 0.78)";

    
}