<?php
	include ("session.php");
		
	$link=Connection();

	$result=mysqli_query($link,"SELECT * FROM `templog` ORDER BY `timeStamp` DESC");
?>

<html>
   <head>
      <title>Sensor Data</title>
   </head>
<body>
   <h2 id="logout"><a href="logout.php">Log Out</a></h2>
   <h1>Temperature / moisture sensor readings</h1>
   <table border="1" cellspacing="1" cellpadding="1">
		<tr>
			<td>&nbsp;Timestamp&nbsp;</td>
			<td>&nbsp;Temperature&nbsp;</td>
			<td>&nbsp;Humidity&nbsp;</td>
			<td>&nbsp;Moisture&nbsp;</td>
		</tr>

      <?php 
  			if($result!==FALSE){
	     		while($row = mysqli_fetch_array($result)) {
	        		printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>", 
	           		$row["timeStamp"], $row["temperature"], $row["humidity"], $row["moisture"]);
	     		}
	     	mysqli_free_result($result);
	     	mysqli_close($link);
	  		}  
      ?>
   </table>
</body>
</html>