<?php
    session_start();
	$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
	if(!empty($sessData['status']['msg'])){
    	$statusMsg = $sessData['status']['msg'];
    	$statusMsgType = $sessData['status']['type'];
    	unset($_SESSION['sessData']['status']);
	}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <title>Login Form</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="login">
    <h2>Log In</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <form action="userAccount.php" method="POST">
      <fieldset>
        <input type="email" placeholder="Email" name="email" id="email" />
        <input type="password" placeholder="Password" name="password" id="password" />
      </fieldset>
      <input type="submit" name="loginSubmit" value="Log In" />
    </form>
    <div class="utilities">
      <a href="#">Forgot Password?</a>
      <a href="registration.php">Sign Up &rarr;</a>
    </div>
  </div>
</body>

</html>