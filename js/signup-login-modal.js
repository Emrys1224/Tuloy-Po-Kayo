var errPw = "<p>* Password must be 8 to 20 characters long containing:</p><ul>"+
			"<li>an uppercase</li>"+
			"<li>a lowercase</li>"+
			"<li>a number</li>"+
			"<li>and a special character (e.g. !,@,#,$)</li></ul>";

// select a tab (signup-login-modal)
$('#signup-login-tabs a').click(function (e) {
	e.preventDefault()
	$(this).tab('show');

	$(this).on('shown.bs.tab', function (e) {
		// clear values except for radio button
		$('.tab-pane input').each(function() {
			if ($(this).attr('type') != "radio") {
				$(this).val("");
			}
		});

		// reset all errors
		$('.err-msg').html("");
		$('#err-password-new').html(errPw);
	})
});

// login modal tab open
$('#signin-nav-link').on('click', function() {
	$('#signup-login-tabs').find('a:first').tab('show')
	$("#acct-renter").prop("checked", true)
});

// login form validation
// email
$('#email-login').focusout(function() {
	var email = $(this).val();
	var err = "";

	if (email) {
		if (!isEmail(email)) {
			err = "<p>* Please enter a valid email</p>";
		}
	}
	else {
		err = "<p>* Please enter an email</p>";
	}

	// display error
	$('#err-email-login').html(err);
});
// password
$('#password').focusout(function() {
	var password = $(this).val();
	var err = "";

	if (password) {
		if (!validPw(password)) err = "<p>* Password is not valid</p>";
	}
	else {
		err = "<p>* Please enter password</p>";
	}

	// display error
	$('#err-password').html(err);
});

// registration form validation
// first name
$('#firstname').focusout(function(){
	var firstname = $(this).val();
	var err = "";

	if (firstname) {
		if (firstname.length > 50) err = "<p>* Please enter name less than 50 letters long</p>";
	}
	else {
		err = "<p>* Please enter your first name</p>";
	}

	// display error
	$('#err-firstname').html(err);
});
// last name
$('#lastname').focusout(function(){
	var lastname = $(this).val();
	var err = "";

	if (lastname) {
		if (lastname.length > 50) err = "<p>* Please enter name less than 50 letters long</p>";
	}
	else {
		err = "<p>* Please enter your last name</p>";
	}

	// display error
	$('#err-lastname').html(err);
});
// email
$('#email-reg').focusout(function() {
	var email = $(this).val();
	var err = "";

	if (email) {
		if (!isEmail(email)) {
			err = "<p>* Please enter a valid email</p>";
		}
		else {
			// verify if account exist
			verifyEmail({email: email, submit: "register"});
		}
	}
	else {
		err = "<p>* Please enter an email</p>";
	}

	// display error
	$('#err-email-reg').html(err);
});
// email confirmation
$('#email-confirm').focusout(function(){
	var email = $('#email-reg').val();
	var emailConfirm = $(this).val();
	var err = "";

	if (emailConfirm === "" && email != "") {
		err = "<p>* Please re-enter your email</p>";
	}
	else if (email != emailConfirm) {
		err = "<p>* The email does not match</p>";
	}

	// display error
	$('#err-email-confirm').html(err);
});
// password
$('#password-new').focusout(function(){
	var password = $(this).val();
	var err = "";

	if (password === "" || !validPw(password)) {
		err = errPw;
	}

	// display error
	$('#err-password-new').html(err);
});
// password confirmation
$('#password-confirm').focusout(function(){
	var password = $('#password-new').val();
	var passwordConfirm = $(this).val();
	var err = "";

	if (passwordConfirm === "" && password != "") {
		err = "<p>* Please re-enter your password</p>";
	}
	else if (password != passwordConfirm) {
		err = "<p>* The password does not match</p>";
	}

	// display error
	$('#err-password-confirm').html(err);
});

// login form submit
$('#btn-login').click(function(e){
	e.preventDefault();

	var email = $('#email-login');
	var password = $('#password');
	var stayLogged = $('#stay-logged').is( ":checked" ) ? "1" : "0";

	// revalidate form
	email.trigger('focusout');
	password.trigger('focusout');

	// verify if email is registered
	// set _SESSION & _COOKIE accordingly
	if (!hasErr()) {
		var data = {
			email: email.val(),
			password: password.val(),
			stayLogged: stayLogged,
			submit: "login"
		}

		// verify if account exist
    	$.ajaxSetup({async:false});		// execute synchronously
		var resp = verifyEmail(data);
   		$.ajaxSetup({async:true});		// set to default

		// if (resp != "Matched") {
		if (resp.indexOf("Matched") === -1) {

			if (resp === "Not registered") {
				// display email error
				$('#err-email-login').html("<p>* Email has not been registered. Please register</p>");
			}
			else if (resp === "Not match") {
				// display password error
				$('#err-password').html("<p>* Password does not match</p>");
			}
		}
		else {
			var url = "";

			if (resp.indexOf("Owner") === -1) {
				//  remove GET request and reload page
				var curUrl = window.location.href;
				url = curUrl.replace("?logout=1", "");
			}
			else {
				url = "owner-profile.php";
			}
				
			// page redirect
			window.location.replace(url);
		}
	}
});

// registration form submit
$('#btn-register').click(function(e){
	// revalidate form
	$('#firstname').trigger('focusout');
	$('#lastname').trigger('focusout');
	$('#email-reg').trigger('focusout');
	$('#email-confirm').trigger('focusout');
	$('#password-new').trigger('focusout');
	$('#password-confirm').trigger('focusout');

	// do not submit if there is an error
	if (hasErr()) {
		e.preventDefault();
	} 
});


// check if there is an error
function hasErr() {
	var err = false;

	$('.err-msg').each(function() {
		if ($(this).children().length > 0) {
			err = true;
		}
	});

	return err;
}

function validPw(password) {
	var err = true;

	if (password) {
		if (password.length < 8 || password.length > 20 || !hasLowerCase(password) || !hasUpperCase(password) || !hasNum(password) || !hasSpecialChar(password)) {
			err = false;
		}
	}
	else {
		err = false;
	}

	return err;
}

function verifyEmail(emailDetails) {
	var url = "helpers/signup-login-confirm.php";
	var resp = "";

    // $.ajaxSetup({async:false});  //execute synchronously

	$.post(url, emailDetails, function(response) {
		resp = response;

		// set error to registration email
		if (response === "Registered") {
			$('#err-email-reg').html("<p><strong>* Email already registered</strong>. Please log in</p>");
		}
	});

    // $.ajaxSetup({async:true});  //return to default

	return resp;
}


