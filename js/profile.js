// display acct setting to its respective DOM element
function displayInfo() {
	// pass the values of acctInfo to their respective DOM element
	$('#acct-settings-view').find('span').each(function() {
		var dataName = $(this).data('name');

		if(acctInfo[dataName] === '') {
			if(dataName === 'linkedAcct') {
				$(this).text('No account linked')
			}
			else {
				$(this).text('No contact number provided')
			}
		}
		else {
			$(this).text(acctInfo[dataName])
		}
	})
	$('#acct-settings-edit').find('.form-control').each(function() {
		var dataName = $(this).attr('name');
		$(this).val(acctInfo[dataName])
	})
}

// Nav links acct name
$('#username').text(acctInfo.firstName)

displayInfo();

// hide the edit view
$('#acct-settings-edit').hide()

// go to acct settings edit mode
$('#btn-edit-settings').on('click', function() {
	toggleView($('#acct-settings-view'), $('#acct-settings-edit'));
})


// save the acct new settings then update the info displayed
$('#btn-save').on('click', function() {
	// take the values from the form and update the acctInfo
	$('#acct-settings-edit').find('.form-control').each(function() {
		var dataName = $(this).attr('name');
		acctInfo[dataName] = $(this).val();
	})

	// update display
	displayInfo();

	// return to settings view mode
	toggleView($('#acct-settings-edit'), $('#acct-settings-view'));
})











