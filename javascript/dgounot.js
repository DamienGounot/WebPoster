function validateNumber() {
    var number, number_el, list, textarea;

    initSubmit();

    number = document.getElementById("numb").value;
    number_el = document.getElementById("numb");
    list = document.getElementById("dropdown");
    textarea = document.getElementById("textarea");



    if (number < 0 || number > 100 || isNaN(number)) {


        if (number < 0 || isNaN(number)) {


            alert("invalid value");
            number_el.style.backgroundColor = "rgba(252, 107, 71, 0.78)";
            list.disabled = true;
            textarea.disabled = true;
            console.log("Le nombre n'est pas valide  (<0 ou isNaN)");
            return false;

        } else {

            textarea.disabled = false;
            alert("invalid value");
            number_el.style.backgroundColor = "rgba(252, 107, 71, 0.78)";
            list.disabled = true;
            console.log("Le nombre n'est pas valide (>100)");
            return false;


        }

    }

    if (number == "") {

        //    alert("empty field");
        number_el.style.backgroundColor = "rgba(252, 107, 71, 0.78)";
        list.disabled = true;
        textarea.disabled = false;
        console.log("Le nombre n'est pas valide (empty)");

        return false;
    }

    if (number > 0 || number < 100) {
        number_el.style.backgroundColor = "white";
        list.disabled = false;
        textarea.disabled = false;
        console.log("Le nombre est valide");

        var limitField = document.getElementById("textarea");
        var limitCount = document.getElementById("countdown");
        limitText(limitField, limitCount);
        return true;

    }

}








function Browser() {
    if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
        //    alert('Opera');
        console.log("User Browser is Opera");

        document.getElementById("episode4").checked = true;

    } else if (navigator.userAgent.indexOf("Chrome") != -1) {
        //  alert("Chrome");
        console.log("User Browser is Chrome");

        document.getElementById("episode2").checked = true;
    } else if (navigator.userAgent.indexOf("Safari") != -1) {
        //    alert('Safari');
        console.log("User Browser is Safari");

        document.getElementById("episode3").checked = true;

    } else if (navigator.userAgent.indexOf("Firefox") != -1) {

        //   alert('Firefox');
        console.log("User Browser is Firefox");

        document.getElementById("episode1").checked = true;

    } else if ((navigator.userAgent.indexOf("MSIE") != -1) || (!!document.documentMode == true)) //IF IE > 10
    {
        //    alert('IE');
        console.log("User Browser is IE");

        document.getElementById("episode5").checked = true;

    } else {
        //   alert('unknown');
        console.log("User Browser is unknown");

        document.getElementById("episode6").checked = true;

    }
}




var idxArray = [];

function initVar() {
    var i, e;
    e = document.getElementById("dropdown");
    for (i = 0; i < e.length; i++) {
        idxArray.push(false);
    }
    e.selectedIndex = -1;
}

function selection() {
    initSubmit();
    var i, n, lastIndex;
    obj = document.getElementById("dropdown");
    n = 0;
    lastIndex = -1;
    for (i = 0; i < obj.length; i++) {
        if (obj[i].selected != idxArray[i])
            lastIndex = i;
        if (obj[i].selected) {
            idxArray[i] = true;
            n++;
        } else
            idxArray[i] = false;
    }
    if (n > 3) {


        for (i = 0; i < obj.length; i++) {

            obj[i].selected = false;

        }

        alert("Please select up to three values");
        console.log("selection is invalid (more than 3 values selected)");

        return false;
    }


    if (n <= 3) {
        obj.style.backgroundColor = "white";
        console.log("The list field is correct");
        return true;
    }
}


function limitText(limitField, limitCount) {

    var limitNum = document.getElementById("numb").value;
    initSubmit();

    if (limitField.value.length > limitNum) {

        limitField.value = limitField.value.substring(0, limitNum);
        alert("Text must have a maximum of " + limitNum + " characters");
        console.log("textarea reach the maximun number of caract");
        limitField.style.backgroundColor = "rgba(252, 107, 71, 0.78)";

        return false;


    } else {


        limitCount.value = limitNum - limitField.value.length;
        limitField.style.backgroundColor = "white";

        return true;
    }



}






function checkForm() {

    var numberForm, listForm, textarea;
    numberForm = validateNumber();
    listForm = selection();

    var limitField = document.getElementById("textarea");
    var limitCount = document.getElementById("countdown");

    textarea = limitText(limitField, limitCount);


    console.log(numberForm);
    console.log(listForm);
    console.log(textarea);

    if (numberForm && listForm && textarea) {

        console.log("The form is valid");

        enableSubmit();
        return true;

    } else {

        console.log("The form is not valid");
        alert("The form is not valid");

        return false;

    }

}

function initSubmit() {
    var button = document.getElementById("submit");
    console.log("init");
    button.disabled = true;

}

function enableSubmit() {

    var button = document.getElementById("submit");
    button.disabled = false;

}


function checkRegistration() {

    var password = document.getElementById("password");
    var repeat = document.getElementById("repeat");

    if (password.value == repeat.value) {


        if (password.value == "") {
            password.style.borderColor = "rgba(252, 107, 71, 0.78)";
            repeat.style.borderColor = "rgba(252, 107, 71, 0.78)";
            return false;
        }

        password.style.borderColor = "#2EFE2E";
        repeat.style.borderColor = "#2EFE2E";
        return true;
    } else {
        password.style.borderColor = "rgba(252, 107, 71, 0.78)";
        repeat.style.borderColor = "rgba(252, 107, 71, 0.78)";
        return false;
    }

}



////////Some BONUS  animations in js////////////


function changeBack() {
    document.getElementById("changeback").style.backgroundColor = "blue";
    console.log("blue");
    setTimeout("setchangeBack()", 1100);

}

function setchangeBack() {
    document.getElementById("changeback").style.backgroundColor = "";
    console.log("de base");
    setTimeout("changeBack()", 1100);
}




function changeBorder() {
    document.getElementById("changeborder").style.borderColor = "blue";
    console.log("blue border");
    setTimeout("setchangeBorder()", 1000);

}

function setchangeBorder() {
    document.getElementById("changeborder").style.borderColor = "";
    console.log("border de base");
    setTimeout("changeBorder()", 1000);
}





////////////////////////////////////////
