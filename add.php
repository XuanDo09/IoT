<?php
   	include("connect.php");
   	
   	$link=Connection();

	$temp = $_GET['temp'];
	$hum = $_GET['hum'];
   $mois = $_GET['mois'];

	$query = "INSERT INTO templog(temperature,humidity,moisture) 
		VALUES ('".$temp."','".$hum."','".$mois."');"; 
   if(mysqli_query($link,$query)){
      echo "Thêm thành công";
   }else{
      echo "Lỗi khi thêm";
   }
   
   mysqli_close($link);

?>
