﻿// holding variables
var convId;
var oldestMsgId;
var noMoreMsgs = false;

// array prototype extension
// returns the lowest value
Array.min = function( array ){
    return Math.min.apply( Math, array );
};

// get messages from database with ajax
// @param reference of where the entry should start(conversation_id and/or message.id)
// @param pos(position) of where the messages is to be appended ("after" for new display; "before" for loading the additional previous messages)
function getMessages(reference, pos) {
	var url = "helpers/get-messages.php";

	// save result in an object and display accordingly
	$.post(url, reference, function(messages) {
		var msgIds = Object.keys(messages);
		// update oldestMsgId if array is not empty
		msgIds.length > 0 ? oldestMsgId = Array.min(msgIds) : null;

		dispMessages(messages, pos);
	}, "json");
}

// add/display a message
// @param messages array of messages
// @param pos(position) of where the messages is to be appended ("after" for new display; "before" for loading the additional previous messages)
function dispMessages(messages, pos) {
	var dispMsg = '';

	if (!jQuery.isEmptyObject(messages)) {
		// build html
		for (var msg in messages) {
			var message = messages[msg];
			dispMsg += '<div class="clearfix"><p class="'+message['sender']+'">'+message['content']+'</p></div>';
		}

		// insert into #msg-body
		if (pos == "after") {
			$('#msgs-body').append(dispMsg);

			// toggle to #messages-view
			toggleView($('#messages-list'), $('#messages-view'), function() {
				$('#msgs-body').scrollTop($('#msgs-body').prop('scrollHeight'))
			});
		}
		else if (pos == "before") {
			var prevScrollHeight = $('#msgs-body').prop('scrollHeight');
			console.log(prevScrollHeight);

			// insert on top of #msgs-body
			$(dispMsg).insertBefore('#msgs-body div:first-child');

			// scroll to end of the added messages
			var newScrollPos = $('#msgs-body').prop('scrollHeight') - prevScrollHeight;
			console.log($('#msgs-body').prop('scrollHeight'));
			console.log(newScrollPos);
			$('#msgs-body').scrollTop(newScrollPos);
		}
	}
	else {
		// insert on top of #msgs-body a notice
		dispMsg = '<div class="clearfix"><p id="end-of-msgs">No more messages to display</p></div>';
		$(dispMsg).insertBefore('#msgs-body div:first-child');

		noMoreMsgs = true;
	}
		
}

// hide the #messages-view
$('#messages-view').hide()

// close conversations
$('#close-btn').on('click', function() {
	noMoreMsgs = false;
	toggleView($('#messages-view'), $('#messages-list'));
})

// view conversations
$('#messages-list h4').on('click', function() {
	// set the text for #msgs-header
	$('#msgs-header h4').text($(this).text());

	// remove the previous content of #msgs-body
	$('#msgs-body').html('');

	// get and display the messages for the coresponding conversation
	convId = $(this).parent().data('conv_id');
	getMessages({convId: convId}, "after");
})

// add previous messages upon reaching the top
$('#msgs-body').scroll(function() {
	var scrollPos = $(this).scrollTop();

	// add 5 previous messages
	if (scrollPos == 0 && !noMoreMsgs) {
		var ref = {
			convId: convId,
			oldestMsgId: oldestMsgId
		};
		
		// prevent successive triggering
		setTimeout(function() { getMessages(ref, "before"); }, 800);
	}
});

