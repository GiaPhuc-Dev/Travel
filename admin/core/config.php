<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "ct275_travelweb";

try {
	$conn = new PDO( "mysql:host=$server; dbname=$dbname", "$username", "$password" );
	$conn>exec('set names utf8');
	$conn->setAttribute(
		PDO::ATTR_ERRMODE,
		PDO::ERRMODE_EXCEPTION
	);
}
catch(PDOException $e) {
	die('Không thể kết nối đến cơ sở dữ liệu');
}

?>
