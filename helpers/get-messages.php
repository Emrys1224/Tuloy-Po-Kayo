<?php 
session_start();

// connect to database
require_once '../core/init.php';

if ($_POST) {
	$userId = $_SESSION['id'];
	$convId = $_POST['convId'];
	$oldestMsgId = $_POST['oldestMsgId'];
	$andFrom = isset($oldestMsgId) ? "AND `id` < $oldestMsgId" : "";

	// retrieve the latest 5 messages or starting from the message id indicated
	$conversation = $db->query("SELECT * FROM `message` WHERE `conversation_id` = $convId $andFrom ORDER BY `message`.`id` DESC LIMIT 5");

	// format and save conversation in an array
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
				elseif ($key === "date_time") {
					// use datetime format ISO 8601
					$temp['date_time'] = date("c", strtotime($value));
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

	// return array in json format
	echo json_encode($messages);
}

?>