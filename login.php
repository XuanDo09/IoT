<?php
   include("connect.php");
   $link=Connection();
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   
      $myemail = mysqli_real_escape_string($link,$_POST['email']);
      $mypassword = mysqli_real_escape_string($link,$_POST['password']); 
      
      $sql = "SELECT * FROM users WHERE email = '$myemail' and password = '$mypassword'";
      $result = mysqli_query($link,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);    
      $count = mysqli_num_rows($result);
		
      if($count == 1) {    
         $_SESSION['email']=$myemail;
         $_SESSION['password']=$mypassword;
         header("location: index.php");
      }else {
      	echo "<script>
			alert('Your Login Name or Password is invalid');
			window.location.href='index.html';
			</script>";
      }
      
   }
?>