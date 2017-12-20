// holding variables
var convId;
var oldestMsgId;
var noMoreMsgs = false;

// get messages from database with ajax
// @param reference of where the entry should start(conversation_id and/or message.id)
function getMessages(reference) {
	var url = "helpers/get-messages.php";

	// save result in an object and display accordingly
	$.post(url, reference, function(messages) { dispMessages(messages) }, "json");
}

// add/display a message
// @param messages array of messages
function dispMessages(messages) {
	var msgIds = Object.keys(messages);
	var msgLength = msgIds.length;

	if (msgLength) {
		var dispMsg = "";
		var emptyBody = $('#msgs-body').html() == "" ? true : false;
		var prevScrollHeight = $('#msgs-body').prop('scrollHeight');

		// loop inreverse
		for (var i = msgLength; i-- > 0;) {
			var message = messages[msgIds[i]];
			var thisDateTime = message['date_time'];
			dispMsg = '<div class="clearfix"><p class="'+message['sender']+'" data-date_time="'+thisDateTime+'">'+message['content']+'</p></div>';

			// insert into #msg-body
			if (emptyBody) {
				$('#msgs-body').append(dispMsg);
				emptyBody = false;
			}
			else {
				var lstMsgDisp = $('#msgs-body div:first-child p');
				var lstDateTime = lstMsgDisp.data('date_time');

				// insert a datetime marker according to the days that passed by
				if (isSameDate(thisDateTime, lstDateTime)) {
					lstMsgDisp.hasClass("date_time") ? $('#msgs-body div:first-child').remove() : null;
				}
				else {
					!lstMsgDisp.hasClass("date_time") ? insDateTimeMarker(lstDateTime) : null;
				}

				$(dispMsg).insertBefore('#msgs-body div:first-child');

				// insert datetime marker for the last displayed message
				!i ? insDateTimeMarker(thisDateTime) : null;
			}
		}

		// scroll to end of the added messages
		var newScrollPos = $('#msgs-body').prop('scrollHeight') - prevScrollHeight;
		$('#msgs-body').scrollTop(newScrollPos);

		// track the oldest message
		oldestMsgId = msgIds.length > 0 ? Array.min(msgIds) : null;
	}
	
	if (msgLength < 5) {
		// insert on the very last message a notice
		dispMsg = '<div class="clearfix"><p id="end-of-msgs">No more messages to display</p></div>';
		$(dispMsg).insertBefore('#msgs-body div:first-child');

		noMoreMsgs = true;
	}
}

// check if same date as the previous message
// @param dayA, dayB dates to compare
function isSameDate(dayA, dayB) {
	return dayA.substring(0,10) == dayB.substring(0,10);
}

// get the difference of days from now
// @param datetime to compare
function getDaysToNow(datetime) {
	var today = new Date(Date.now());
	var diff_ms = today - datetime;
	return Math.round(diff_ms/ONE_DAY_MS);
}

// get time (HH:MM) in 12 hour format
// @param datetime to get the time from
function formatAMPM(datetime) {
	var hours = datetime.getHours();
	var minutes = datetime.getMinutes();
	var ampm = hours >= 12 ? 'pm' : 'am';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = hours + ':' + minutes + ' ' + ampm;
	return strTime;
}

// insert datetime marker
// @param datetime to insert (ISO 8601 format)
function insDateTimeMarker(datetime) {
	var dateObj = new Date(datetime);
	var marker = "";
	var daysPassed = getDaysToNow(dateObj);

	if (daysPassed < 7) {
		marker = DAY_OF_WEEK[dateObj.getDay()] + " at " + formatAMPM(dateObj);
	}
	else if (daysPassed < 365){
		marker = MONTH[dateObj.getMonth()] + " " + dateObj.getDate() + " at " + formatAMPM(dateObj);
	}
	else {
		marker = MONTH[dateObj.getMonth()] + " " + dateObj.getDate() + ", " +
		dateObj.getFullYear() + " at " + formatAMPM(dateObj);
	}

	marker = '<div class="clearfix"><p class="date_time" data-date_time="'+datetime+'">'+marker+'</p></div>';
	$(marker).insertBefore('#msgs-body div:first-child');
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

