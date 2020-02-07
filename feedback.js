$(document).ready(init);

function init() {

    $(".error").hide();
    //    1) All fields are required
    $("#submit").click(validate);
}

function validate(event) {
    $(".error").hide();
    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var allFields = firstName + lastName + email + phone;
    var hasNumber = /\d/;
    var hasLetter = /\[a-zA-Z]/;
    var hasSpecial = /\[$!]/;
    //


    if (firstName == "") {
        $("label#firstName_error").show();
        //$("label#firstName_error").attr("class", "error");
        //return false;
    }

    if (lastName == "") {

        //return false;
    }

    if (email == "") {
        //$("input#email").attr("placeholder", "Email Required");
        //$("input#email").attr("class", "error");
        //return false;
    }

    if (phone == "") {

        //return false;
    }

    if ((allFields == "") ||(firstName == "")||(lastName == "")||(email == "")||(phone == "")) {
        $(".error").show();
        return false;
    }

    if((hasNumber.test(firstName) || hasNumber.test(lastName)) == true){
        alert("No numbers allowed");
        return false;
    }

alert("All Fields: " + allFields);
}
