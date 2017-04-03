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
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Register Form</title>
        		
		<link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/mystyle.css">
	</head>
	<body>
		<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h2>Sign up</h2>
                	<?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
					<form method="post" action="userAccount.php">
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm_password" id="confirm_password"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input type="submit" name="signupSubmit" value="Register" />
						</div>
						
					</form>
				</div>
			</div>
		</div>

        <script src="vendors/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>