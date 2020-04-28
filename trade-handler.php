<?php
if('POST' === $_SERVER['REQUEST_METHOD']) {
    session_start();
    require_once 'Dao.php';

    $dao = new Dao();

    $errors = array();

    $coin = filter_input(INPUT_POST, 'coin', FILTER_SANITIZE_STRING);
    $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
    $difference = filter_input(INPUT_POST, 'difference', FILTER_SANITIZE_STRING);
    $money = filter_input(INPUT_POST, 'money', FILTER_SANITIZE_STRING);

    if (empty($coin)) {
        array_push($errors, "Coin is required.");
    }

    if (empty($amount)) {
        array_push($errors, "Amount is required.");
    }

    if (empty($price)) {
        array_push($errors, "Price is required.");
    }

    if (empty($difference)) {
        array_push($errors, "Difference is required.");
    }

    if (empty($money)) {
        array_push($errors, "Money is required.");
    }

    if (count($errors) == 0) {
        $dao->saveTrade($coin, $price, $amount, $difference, $money);
        $_SESSION['coin'] = $coin;
        $_SESSION['price'] = $price;
        $_SESSION['amount'] = $amount;
        $_SESSION['difference'] = $difference;
        $_SESSION['money'] = $money;
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