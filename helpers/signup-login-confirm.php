<?php 
session_start();

// connect to database
require_once '../core/init.php';

if (array_key_exists("submit", $_POST)) {
	$email = $_POST['email'];
	$submitFr = $_POST['submit'];

	$acctDetails = $db->query("SELECT `password`, `id`,`status` FROM `account` WHERE `email` = '$email'")->fetch();

	if ($acctDetails) {
		if ($submitFr === "register") {
			echo "Registered";
		}
		elseif ($submitFr === "login") {
			$inputPw = $_POST['password'];
			$stayLogged = $_POST['stayLogged'];
			$id = $acctDetails['id'];
			$pwHash = $acctDetails['password'];

			if(password_verify($inputPw, $pwHash)) {
				// set session
				$_SESSION['id'] = $id;

				// set cookie
				if ($stayLogged === "1") {
					setcookie("id", $id, time() + 60*60*24*365, "/");
				}

				echo "Matched, ".$acctDetails['status'];
			}
			else {
				echo "Not match";
			}
		}


	}
	else {
		echo "Not registered";
	}
}

 ?>