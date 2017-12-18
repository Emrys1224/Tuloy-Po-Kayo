// holding variables
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
function getMessages(reference) {
	var url = "helpers/get-messages.php";

	// save result in an object and display accordingly
	$.post(url, reference, function(messages) {
		var msgIds = Object.keys(messages);
		// track the oldest message
		oldestMsgId = msgIds.length > 0 ? Array.min(msgIds) : null;

		dispMessages(messages);
	}, "json");
}

// add/display a message
// @param messages array of messages
function dispMessages(messages) {
	if (!jQuery.isEmptyObject(messages)) {
		var keys = Object.keys(messages);
		var dispMsg = "";
		var emptyBody = $('#msgs-body').html() == "" ? true : false;
		var prevScrollHeight = $('#msgs-body').prop('scrollHeight');

		// loop inreverse
		for (var i = keys.length; i-- > 0;) {
			var message = messages[keys[i]];
			dispMsg = '<div class="clearfix"><p class="'+message['sender']+' data-date_time="'+message['date_time']+'">'+message['content']+'</p></div>';

			// insert into #msg-body
			if (emptyBody) {
				$('#msgs-body').append(dispMsg);
				emptyBody = false;
			}
			else {
				$(dispMsg).insertBefore('#msgs-body div:first-child');
			}
		}

		// scroll to end of the added messages
		var newScrollPos = $('#msgs-body').prop('scrollHeight') - prevScrollHeight;
		$('#msgs-body').scrollTop(newScrollPos);
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
	getMessages({convId: convId});

	// toggle to #messages-view
	toggleView($('#messages-list'), $('#messages-view'), function() {
		$('#msgs-body').scrollTop($('#msgs-body').prop('scrollHeight'));
	});
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
		setTimeout(function() { getMessages(ref); }, 800);
	}
});

