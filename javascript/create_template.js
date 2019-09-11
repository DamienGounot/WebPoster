function verifName() {
    
    

    var name = document.getElementById("name");
    
        if (name.value == "") {
            name.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else {
        name.style.borderColor = "#ffffff";
        return true;
    }

}

function verifPrice() {
    
    

    var price = document.getElementById("price");
    
        if (price.value == "") {
            price.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else {
        price.style.borderColor = "#ffffff";
        return true;
    }

}

function verifDescription() {
    
    

    var description = document.getElementById("description");
    
        if (description.value == "") {
            description.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }else {
        description.style.borderColor = "#ffffff";
        return true;
    }

}





function checkCreation() {
    

    
    var nameOk = verifName();
    var priceOk = verifPrice();
    var descriptionOk = verifDescription();
    
    if(nameOk && priceOk && descriptionOk){
        return true;
}else {
        return false;
    }
}