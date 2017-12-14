// hide the #messages-view
$('#messages-view').hide()

// view conversations
$('#messages-list h4').on('click', function() {
	// set the text for #msgs-header
	$('#msgs-header h4').text($(this).text());

	// get conversation Id
	var convId = $(this).parent().data('conv_id');

	// get and display the messages for the coresponding conversation
	getMessages({convId: convId});

	toggleView($('#messages-list'), $('#messages-view'), function() {
		$('#msgs-body').scrollTop($('#msgs-body').prop('scrollHeight'))
	});
})

// close conversations
$('#close-btn').on('click', function() {
	toggleView($('#messages-view'), $('#messages-list'));
})

// get messages from database with ajax
function getMessages(convId) {
	var url = "helpers/get-messages.php";

	// save result in an object and display accordingly
	$.post(url, convId, function(response) {
		var messages = response;

		// remove the previus content of #msgs-body
		$('#msgs-body').html('');

		// display the messages
		for (var msg in messages) {
			dispMessages(messages[msg]);
		}

	}, "json");
}

// add/display a message
function dispMessages(message) {
	var dispMsg = '<div class="clearfix"><p class="'+message['sender']+'">'+message['content']+'</p></div>';
	$('#msgs-body').append(dispMsg);
}