<?php
#$host = "mysql4.000webhost.com";
#$dbname = "a6580394_a";
#$db_username = "a6580394_b";
#$db_password = "qwer1234";

$host = "localhost";
$dbname = "a8330719_db";
$db_username = "root";
$db_password = "baksosapi";


$dbc = "mysql:host=$host;dbname=$dbname";


try {
	$db = new PDO($dbc, $db_username, $db_password);
}
catch (PDOException $e) {
	error_log('PDO Exception: '.$e->getMessage());
	die('There is an error. Check it N');
}


?>