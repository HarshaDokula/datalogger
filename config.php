<?php
	$host = "localhost"; // Change your host only if you are deploying it online
	$username = "root"; // Enter your username here
	$pass = ""; // Enter you password here
	$dbname = "datalogger"; // Enter your database name here
	$conn = mysqli_connect($host,$username,$pass) or die("Connection Error: ".mysqli_error($conn));
	$db = mysqli_select_db($conn,$dbname) or die("Database error: ".mysqli_error($conn));
?>