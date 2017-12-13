// hide the #messages-view
$('#messages-view').hide()

// view conversations
$('#messages-list h4').on('click', function() {
	// var index = $(this).parent().data('index');
	// displayMessages(index);

	toggleView($('#messages-list'), $('#messages-view'), function() {
		$('#msgs-body').scrollTop($('#msgs-body').prop('scrollHeight'))
	});

	console.log('ok1');
})

// close conversations
$('#close-btn').on('click', function() {
	toggleView($('#messages-view'), $('#messages-list'));
})