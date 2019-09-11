$(document).ready(function () {
    $('#table').DataTable();
});






/*anim for multimedia page*/


$(document).ready(function () {
    $("#body-anim").ready(function slide() {
        $("#changeText").css("color", "white    ")
            .slideUp(2000)
            .slideDown(2000);

        setInterval(slide(), 1000);

    });
});



$(document).ready(function () {
    $("#premiere_ligne").toggle();
    setInterval(function () {
        $("#premiere_ligne").toggle();
    }, 1000);

});


$(document).ready(function () {
    $("#changeborder").hover(function () {
        $("#changeborder").animate({
            deg: 360
        }, {
            duration: 1200,
            step: function (now) {
                $("#changeborder").css({
                    transform: 'rotate(' + now + 'deg)'
                });
            }
        });
    });
});

$(document).ready(function () {
    $("#changeback").hover(function () {
        $("#changeback").animate({
            deg: 360
        }, {
            duration: 1200,
            step: function (now) {
                $("#changeback").css({
                    transform: 'rotate(' + now + 'deg)'
                });
            }
        });
    });
});



/* form page */




$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "https://barka.foi.hr/WebDiP/2018/materijali/zadace/dz3/userNameSurname.php?all",
        dataType: "xml",
        success: function (xml) {
            var xmlDocument = $.parseXML(xml)
            var $xml = $(xmlDocument);
            $(xml).find('name').each(function () {
                var $name = $(this).text();
                $('<option>' + $name + '</option>').appendTo('#name')
            })
        }
    });

});



$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "https://barka.foi.hr/WebDiP/2018/materijali/zadace/dz3/userNameSurname.php?all",
        dataType: "xml",
        success: function (xml) {
            var xmlDocument = $.parseXML(xml)
            var $xml = $(xmlDocument);
            $(xml).find('surname').each(function () {
                var $surname = $(this).text();
                $('<option>' + $surname + '</option>').appendTo('#surname')
            })
        }
    });

});




$(document).ready(function () {
    console.log("init disable password");
    $("#password").prop("disabled", true);


});



$(document).ready(function () {
    console.log("init disable username");

    $("#username").prop("disabled", true);

});




$(document).ready(function () {
    $('#email').blur(function () {
        email_address = $(this);
        email_regex = /^([a-zA-Z0-9]+)(\.[a-zA-Z0-9_-]+)*[@]([a-zA-Z0-9]+)*(\.[a-zA-Z0-9_-]+)*/;
        if (!email_regex.test(email_address.val())) {
            $(this).css("borderColor", "rgba(252, 107, 71, 0.78)");
            return false;
        } else {
            $(this).css("borderColor", "");

            return true;
        }
    });
});








$(document).ready(function () {
    $.getJSON("../json/states.json", function (data) {
        $.each(data, function (i, field) {
            $("#state").append('<option>' + field + '<option>');
            $("state").autocomplete();


        });
    });

});



$(document).ready(function () {
    $("#name_input").change(function () {
        alert("The AJAX name has been changed.");


    });


});

