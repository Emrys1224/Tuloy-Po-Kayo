<?php 

// connect to database
include '../core/init.php';

// add_account procedure test
$f_name = 'Mack';
$l_name = 'Donald';
$email = 'mcdo@mail.com';
$password = 'password';
$status = 'Anonymous';

$result = $db->query("CALL add_account('$f_name', '$l_name', '$email', '$password', '$status', @inserted)", MYSQLI_STORE_RESULT);

// $content = $result->fetch_array(MYSQLI_ASSOC);

// print_r($content);


echo "<br><br>ok";

 ?>