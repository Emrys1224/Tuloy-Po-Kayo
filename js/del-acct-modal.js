// confirm deletion of account
$('#btn-del-acct').on('click', function() {
	$('#del-acct-modal').modal('hide')
	$('#del-acct-modal').on('hidden.bs.modal', function() {
		$('#acct-delted-modal').modal('show')
		setTimeout('redirectToHome()', 3000);
	})
})

function redirectToHome() {
	window.location.replace('index.html');
}
