<?php
if('POST' === $_SERVER['REQUEST_METHOD']) {
    session_start();
    require_once 'Dao.php';

    $dao = new Dao();

    $errors = array();

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password_1 = filter_input(INPUT_POST, 'password_1', FILTER_SANITIZE_STRING);
    $password_2 = filter_input(INPUT_POST, 'password_2', FILTER_SANITIZE_STRING);

    if (empty($username)) {
        array_push($errors, "Username is required.");
    }

    if (empty($email)) {
        array_push($errors, "Email is required.");
    }

    if (empty($password_1)) {
        array_push($errors, "Password is required.");
    }

    if ($password_1 != $password_2){
        array_push($errors, "Passwords do not match.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Invalid email format.");
    }

    if(strlen($password_1) < 6 or strlen($password_1) > 50){
        array_push($errors, "Password must be between 6 and 50 characters.");
    }

    if ( !preg_match('/^[a-zA-Z0-9_-]{6,50}$/', $username) ) {
        array_push($errors, "Username can only contain letters, numbers, hyphens, and underscores.
        And must be between 6 and 50 characters.");
    }


        $user = $dao->getUser($username, $email);
    if ($user->rowCount() > 0) {
        array_push($errors, "User already exists.");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        if ($username == "ryanmitchell") {
            $dao->saveUser($email, $username, $password, 'Y');
            $_SESSION['isAdmin'] = "true";
        } else {
            $dao->saveUser($email, $username, $password, 'N');
        }
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "true";
        unset($_SESSION['form']);
        header('Location: index.php');
    } else {
        $_SESSION['form'] = $_POST;
        $_SESSION['errors'] = $errors;
        header("Location: profile.php");
        exit;
    }
}
?>