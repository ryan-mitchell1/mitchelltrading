<?php
if('POST' === $_SERVER['REQUEST_METHOD']) {
    session_start();
    require_once 'Dao.php';

    $dao = new Dao();

    $errors = array();

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($username)) {
        array_push($errors, "Username is required.");
    }
    if (empty($password)) {
        array_push($errors, "Password is required.");
    }

    $salt = "jfieewiof1321121";
    print_r(md5($salt.$password));
    $user = $dao->getLoginUser($username, md5($salt.$password));

    if($user->rowCount() <= 0) {
        array_push($errors, "User does not exist or username and password do not match.");
    }
    if(count($errors) == 0) {
        $_SESSION['username'] = $username;
        $_SESSION['show_login_message'] = "true";
        $_SESSION['success'] = "true";
        if($username == ryanmitchell){
            $_SESSION['isAdmin'] = "true";
        }
        unset($_SESSION['form']);
        header('Location: index.php');
    } else {
        $_SESSION['form'] = $_POST;
        $_SESSION['errors'] = $errors;
        header("Location: login.php");
        exit;
    }

}