<?php 
session_start();

// connect to database
require_once '../core/init.php';

if ($_POST) {
	$userId = $_SESSION['id'];
	$convId = $_POST['convId'];

	// retrieve messages
	$conversation = $db->query("SELECT * FROM `message` WHERE  `conversation_id` = '$convId'");

	// save conversation in an array
	$messages = array();
	while ($message = $conversation->fetch()) {
		// save sender, time stamp, and content in an array
		$temp = array();
		foreach ($message as $key => $value) {
			if ($key !== "id" AND $key !== "conversation_id") {
				// determine the sender
				if ($key === "sender") {
					$sender = $value === $userId ? "self" : "other";
					$temp['sender'] = $sender;
				}
				else {
					$temp[$key] = $value;
				}
			}
		}

		// add to messages array
		$index = $message['id'];
		$messages[$index] = $temp;
	}

	// return array as json
	echo json_encode($messages);
}

?>