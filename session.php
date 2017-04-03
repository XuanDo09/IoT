<?php
	session_start();
	$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
	if(!empty($sessData['status']['msg'])){
		$statusMsg = $sessData['status']['msg'];
		$statusMsgType = $sessData['status']['type'];
		unset($_SESSION['sessData']['status']);
	}
	if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
		include 'user.php';
		$user = new User();
		$conditions['where'] = array(
			'id' => $sessData['userID'],
		);
		$conditions['return_type'] = 'single';
		$userData = $user->getRows($conditions);
	}else{
		header("Location: login.php");
	}
?>