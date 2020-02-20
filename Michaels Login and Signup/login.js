$(document).ready(init);

function init(){
	$(".error").hide();
	$("#submit_btn").click(validate);
}
function validate(event){
	$(".error").hide();

	var password = $("input#password").val();
	var email = $("input#email").val();

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

	if (password != "" && email != ""){
      	alert("Login Succesful!");
    }

	var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone;

	return false;
}

  $(function() {
    $('.error').hide();
    $(".button").click(function() {
      
      $('.error').hide();

      var email = $("input#email").val();
      if (email == "") {
        $("label#email_error").show();
        $("input#email").focus();
      }

      if (password != "" && email != ""){
      	alert("Login Succesful!");
      }

      var password = $("input#password").val();
      if (password == "") {
        $("label#password_error").show();
        $("input#password").focus();
        return false;
      }

    });
  });