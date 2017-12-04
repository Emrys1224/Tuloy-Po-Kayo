<?php

$host = 'localhost';
$db   = 'tuloy_po_kayo';
$user = 'root';
$pass = 'K129067l';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => true,
    PDO::MYSQL_ATTR_FOUND_ROWS => true
];

try {
	$db = new PDO($dsn, $user, $pass, $opt);
}
catch(Exception $e) {
	// echo $e->getMessage();
	echo "Can not connect at the moment<br>Please try again later";
}


require_once $_SERVER['DOCUMENT_ROOT'].'/Tuloy-Po-Kayo/config.php';
// require_once BASEURL.'helpers/helpers.php';
	