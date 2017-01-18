<?php
	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$databaseName = "dedications";
	$con = mysqli_connect($serverName, $userName, $password, $databaseName);
	if(!$con)
	{
		die("Error: Could not connect ".mysqli_connect_error());
		exit();
	}
?>