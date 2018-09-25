<?php
	
	$server   = "localhost";
	$username = "root";
	$password = 'msconfig';
	$db       = 'uaemv3';
	$con      = mysqli_connect($server, $username, $password, $db);
	header("Content-Type: text/html;charset=utf-8");
	$acentos = $con->query("SET NAMES 'utf8'");
?>