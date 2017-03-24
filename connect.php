<?php
	function Connection(){
		
	$localhost="localhost";
	$user="root";
	$pass="";
	$db="iot";
	
	$connection = mysqli_connect($localhost, $user, $pass);
	
	if (!$connection) {
		die('MySQL ERROR: ' . mysqli_error());
	}
	
	mysqli_select_db($connection,$db) or die( 'MySQL ERROR: '. mysqli_error($connection) );
	
	return $connection;
}
?>