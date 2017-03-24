<?php
	include("connect.php");

	$link=Connection();

	session_start();

	$email_check=$_SESSION['email'];
	$pass_check=$_SESSION['password'];

	$sql = "SELECT * FROM users WHERE email = '$email_check' and password = '$pass_check'";

	$result = mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

	$email_session = $row['email'];
	$pass_session = $row['password'];
	$user_session = $row['username'];

	if(!isset($email_session) && !isset($pass_session)){	
		mysqli_close($link);
		header('Location: login.html');	
	}
?>