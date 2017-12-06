// hide the edit view
$('#acct-settings-edit').hide()

// go to acct settings edit mode
$('#btn-edit-settings').on('click', function() {
	toggleView($('#acct-settings-view'), $('#acct-settings-edit'));
})


// save the acct new settings then update the info displayed
$('#btn-save').on('click', function() {
	// return to settings view mode
	toggleView($('#acct-settings-edit'), $('#acct-settings-view'));
})











