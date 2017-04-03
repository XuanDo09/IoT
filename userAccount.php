<?php
    session_start();
    include 'user.php';
    $user = new User();
    if(isset($_POST['signupSubmit'])){
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
            if($_POST['password'] !== $_POST['confirm_password']){
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Confirm password must match with the password.'; 
            }else{
                $prevCon['where'] = array('email'=>$_POST['email']);
                $prevCon['return_type'] = 'count';
                $prevUser = $user->getRows($prevCon);
                if($prevUser > 0){
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Email already exists, please use another email.';
                }else{
                    $userData = array(
                        'username' => $_POST['username'],
                        'email' => $_POST['email'],
                        'password' => md5($_POST['password']),
                    );
                    $insert = $user->insert($userData);
                    if($insert){
                        $sessData['status']['type'] = 'success';
                        $sessData['status']['msg'] = 'You have registered successfully, log in with your credentials.';
                    }else{
                        $sessData['status']['type'] = 'error';
                        $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                    }
                }
            }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.'; 
        }
        $_SESSION['sessData'] = $sessData;
        $redirectURL = ($sessData['status']['type'] == 'success')?'login.php':'registration.php';
        header("Location:".$redirectURL);
    }elseif(isset($_POST['loginSubmit'])){
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            $conditions['where'] = array(
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'status' => '1'
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
            if($userData){
                $sessData['userLoggedIn'] = TRUE;
                $sessData['userID'] = $userData['id'];
                $sessData['status']['type'] = 'success';
                $sessData['status']['msg'] = 'Welcome '.$userData['username'].'!';
            }else{
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Wrong email or password, please try again.'; 
            }
        }else{
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Enter email and password.'; 
        }
        $_SESSION['sessData'] = $sessData;
        $redirectURL = ($sessData['status']['type'] == 'success')?'index.php':'login.php';
        header("Location:".$redirectURL);
    }elseif(!empty($_REQUEST['logoutSubmit'])){
        unset($_SESSION['sessData']);
        session_destroy();
        $sessData['status']['type'] = 'success';
        $sessData['status']['msg'] = 'You have logout successfully from your account.';
        $_SESSION['sessData'] = $sessData;
        header("Location:login.php");
    }else{
        header("Location:login.php");
    }
?>