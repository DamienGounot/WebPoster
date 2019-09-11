

function verifTitle() {
    var title = document.getElementById("title");
    
        if (title.value == "") {
            title.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else {
        title.style.borderColor = "#ffffff";
        return true;
    }

}



function verifTagline() {
    
    

    var tagline = document.getElementById("tagline");

        if (tagline.value == "") {
            tagline.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else{
            
        user.style.borderColor = "#ffffff";
        return true;
            
        }

}

function verifQuantity() {
    
    

    var quantity = document.getElementById("quantity");
    



        if (quantity.value == "") {
            quantity.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else {
        quantity.style.borderColor = "#ffffff";
        return true;
    }

}


function verifContent() {
    
    

    var content = document.getElementById("content");
    
        if (content.value == "") {
            content.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else {
        content.style.borderColor = "#ffffff";
        return true;
    }

}




function checkPurchase() {
    

    
    var titleOK = verifTitle();
    var taglineOk = verifTagline();
    var quantityOk = verifQuantity();
    var contentOk = verifContent();
    
    if(titleOK && taglineOk && quantityOk && contentOk){
        return true;
}else {
        return false;
    }
}


