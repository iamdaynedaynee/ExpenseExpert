<?php
	// SOLANO, Meryll Dayne B.
	// ITMC231 Platform Technologies
	// BS IT - 2ND YEAR
	// Final Requirement
	// Honor Code:
	// This is my own work and I have not received any unauthorized help in completing this. 
	// I have not copied from my classmate, friend, nor any unauthorized resource. 
	// I am well aware of the policies stipulated in the handbook regarding academic dishonesty. 
	// If proven guilty, I won't be credited any points for this endeavor.

	include "database_conn.php";
	session_start();
	
	// initialize variables using the data provided by the user
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// insert gathered data into the database
	if(empty($username) && empty($password)){
		echo '<script> alert("Signup failed. Try again.");</script>';
		echo '<script> window.location.href="login.php" </script>';
	}
	else {
		$query = "INSERT INTO db_signup_data (username, password) VALUES ('$username', '$password')";
		$result = mysqli_query($database_conn, $query);
		echo '<script> alert("Account successfully created. Please login your account to proceed.");</script>';
		echo '<script> window.location.href="home.php" </script>';
	}
?>