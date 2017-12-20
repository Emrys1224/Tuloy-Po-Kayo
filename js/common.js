var ONE_DAY_MS = 1000*60*60*24;
var ONE_YEAR_MS = ONE_DAY_MS*365;
var DAY_OF_WEEK = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
var MONTH = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

// array prototype extension
// returns the lowest value
Array.min = function( array ){
    return Math.min.apply( Math, array );
};

// email validation
function isEmail(email) {
    var rgx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return rgx.test(email);
}

function hasLowerCase(str) {
    return (/[a-z]/.test(str));
}
function hasUpperCase(str) {
    return (/[A-Z]/.test(str));
}
function hasNum(str) {
    return (/[0-9]/.test(str));
}
function hasSpecialChar(str) {
    return (/[~`!@#$%\^&*()+=\-_\[\]\\';,/{}|\\":<>\?]/.test(str));
}

/* toggle view
 * @param curView is the current view
 * @param newView is the view to be shown
 * @param callback is a callback function
 */
function toggleView(curView, newView, callback) {
	curView.fadeOut(200, function() {
		newView.fadeIn(200)
		if(typeof(callback) === 'function') {
			callback();
		}
	})

}

function setMainBgPos() {
	var mainHeight = $('main').height();

	if(mainHeight < 600) {
		$('main.row').css('background-position-y', '-320px')
	}
}

setMainBgPos();

// callapsible nav
$('.collapse').collapse()






