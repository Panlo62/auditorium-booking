<?php
    $server = "localhost";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($server, $username, $password);
	if (!$conn){
		echo "success";
	}
	else{
		die("Error". mysqli_connect_error());
	}
	$sql = "CREATE DATABASE Auditorium";
    mysqli_query($conn, $sql);
	$sql = "CREATE TABLE Users ('UserName' VARCHAR(120), 'Password' PASSWORD, 'Email' VARCHAR(50) PRIMARY KEY, 'CreatedOn' DATETIME)";
    mysqli_query($conn, $sql);
    $sql = "CREATE TABLE Bookings ('EventID' SERIAL UNIQUE, 'Email' VARCHAR(50) FOREIGN KEY, 'EventName' VARCHAR(120), 'Description' VARCHAR(500), 'Date' DATE, 'BookedOn' DATETIME)";
	mysqli_query($conn, $sql);
?>