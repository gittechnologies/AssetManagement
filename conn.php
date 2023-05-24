<?php

$databaseHost = 'localhost';
$databaseName = 'pms';
$databaseUsername = 'git_assets';
$password = 'git_assets@321';
$message="";


try {

	$dbConn = new PDO("mysql:host=$databaseHost;dbname={$databaseName}",$databaseUsername,$password);
	
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	
} catch(PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
 }
?>

