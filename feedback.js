$(document).ready(init);

function init() {

    $(".error").hide();
    //    1) All fields are required
    $("#submit").click(validate);
}

function validate(event) {

    var firstName = $("#firstName").val();
    var lastName = $("#lastName").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var allFields = firstName + lastName + email + phone;
    var hasNumber = /\d/;
    var hasLetter = /\[a-zA-Z]/;
    var hasSpecial = /\[$!]/;
    alert("All Fields: " + allFields);

/*
    if (firstName == "") {
        $("input#firstname").attr("placeholder", "First Name Required");
        $("input#firstname").attr("class", "error");
    }

    if (lastName == "") {
        $("input#lastname").attr("placeholder", "Last Name Required");
        $("input#lastname").attr("class", "error");
    }

    if (email == "") {
        $("input#email").attr("placeholder", "Email Required");
        $("input#email").attr("class", "error");
    }

    if (password == "") {
        $("input#password").attr("placeholder", "Password Required");
        $("input#password").attr("class", "error");
    }

    if ((allFields == "") ||(firstName == "")||(lastName == "")||(email == "")||(password == "")) {
        $("input").attr("class", "input");
        return false;
    }
    if((hasNumber.test(firstName) || hasNumber.test(lastName)) == true){
        alert("No numbers allowed");
        return false;
    }

    if(password.length < 8 && (hasLetter.test(password) && hasNumber.test(password) && hasSpecial.test(password)) == false){
        alert("Password incorrect");
        return false;
    }
*/

}
