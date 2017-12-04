// open registration modal with owner radio button selected
$('#btn-reg-owner').on('click', function() {
	$('#signup-login-tabs').find('a:last').tab('show')
	$("#acct-owner").prop("checked", true)
})



