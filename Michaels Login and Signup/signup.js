$(document).ready(init);

function init(){
	$(".error").hide();
	$("#submit_btn").click(validate);
}
function validate(event){
	$(".error").hide();

	var firstname = $("input#firstname").val();
	var hasNumber = /\d/;
	var passwordCheck = /^(?=.*\d)(?=.*[!$@#%^&*])(?=.*[a-z]).{8,100}$/;
	var password = $("input#password").val();
	var email = $("input#email").val();
	var lastname = $("input#lastname").val();

    if(hasNumber.test(firstname) == true){
    	$("label#firstname_error").show();
		$("input#firstname").focus();
		alert("First name cannot contain numbers!");
		return false;
    }

    if(hasNumber.test(lastname) == true){
    	$("label#lastname_error").show();
		$("input#lastname").focus();
		alert("Last name cannot contain numbers!");
		return false;
    }

    if(passwordCheck.test(password) == false){
    	$("label#password_error").show();
		$("input#password").focus();
		alert("Password MUST contain 1 letter, 1 number, 1 special character, and be atleast 8 characters long!");
		return false;
    }

	if (firstname == ""){
		$("label#firstname_error").show();
		$("input#firstname").focus();
		return false;
	}

	if (lastname == ""){
		$("label#lastname_error").show();
		$("input#lastname").focus();
		return false;
	}

	if (email == ""){
		$("label#email_error").show();
		$("input#email").focus();
		return false;
	}

	if (password == ""){
		$("label#password_error").show();
		$("input#password").focus();
		return false;
	}

	var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone;

	return false;
}

  $(function() {
    $('.error').hide();
    $(".button").click(function() {
      
      $('.error').hide();
      var firstname = $("input#firstname").val();
      if (firstname == "") {
        $("label#firstname_error").show();
        $("input#firstname").focus();
      }

      var lastname = $("input#lastname").val();
      if (lastname == "") {
        $("label#lastname_error").show();
        $("input#lastname").focus();
      }

      var email = $("input#email").val();
      if (email == "") {
        $("label#email_error").show();
        $("input#email").focus();
      }

      var passwordCheck = /^(?=.*\d)(?=.*[!$@#%^&*])(?=.*[a-z]).{8,100}$/;
      var password = $("input#password").val();
      if (passwordCheck.test(password) == false) {
        $("label#password_error").show();
        $("input#password").focus();
        return false;
      }
    });
  });