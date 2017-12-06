<?php 

// account details
$id = 0;
$username = "";
$acctType = "";

if (array_key_exists("logout", $_GET)) {
    // Clear _SESSION and _COOKIE
    unset($_SESSION['id']);
    $_COOKIE["id"] = "";
    setcookie("id", false, time() - 60*60, "/");
}

if (array_key_exists("id", $_COOKIE) AND $_COOKIE['id']) {
	$_SESSION['id'] = $_COOKIE['id'];
}

if (array_key_exists("id", $_SESSION) AND $_SESSION['id']) {
	// set account details
	$id = $_SESSION['id'];
	$acctDetails = $db->query("SELECT CONCAT(`firstname`, ' ', `lastname`) AS `name`, `status` FROM `account` WHERE `id` = '$id'")->fetch();
	$username = $acctDetails['name'];
	$acctType = $acctDetails['status'];
}

 ?>