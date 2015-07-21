<?php

// connect to database

$host = "localhost";
$dbname = "bumba";
$db_username = "root";
$db_password = "bumbapass";

$dbc = "mysql:host=$host;dbname=$dbname";

try {
	$db = new PDO($dbc, $db_username, $db_password);
}
catch (PDOException $e) {
	error_log('PDO Exception: '.$e->getMessage());
	die('There is an error. Check it N');
}

?>