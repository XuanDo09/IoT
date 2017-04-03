<?php
   	include("connect.php");

	$link=Connection();

	$id = $_GET['id'];
	$temp = $_GET['temp'];
	$hum = $_GET['hum'];
	$mois = $_GET['mois'];

	$query = "INSERT INTO templog(id_sensor,temperature,humidity,moisture) 
			VALUES ('".$id."','".$temp."','".$hum."','".$mois."');";

	if(mysqli_query($link,$query)){
		echo "Thêm thành công";
	}
	else{
		echo "Lỗi khi thêm";
	}

	mysqli_close($link);
?>