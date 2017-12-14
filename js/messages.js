// hide the #messages-view
$('#messages-view').hide()

// view conversations
$('#messages-list h4').on('click', function() {
	var convId = $(this).parent().data('conv_id');
	console.log(convId);

	getMessages({convId: convId});

	toggleView($('#messages-list'), $('#messages-view'), function() {
		$('#msgs-body').scrollTop($('#msgs-body').prop('scrollHeight'))
	});

	console.log('ok1');
})

// close conversations
$('#close-btn').on('click', function() {
	toggleView($('#messages-view'), $('#messages-list'));
})

function getMessages(convWith) {
	var url = "helpers/get-messages.php";

	$.post(url, convWith, function(response) {
		resp = response;

		alert(response);
	});
}