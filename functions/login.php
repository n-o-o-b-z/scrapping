<?php
session_start();

require_once '../class/Connection.php';
require_once '../class/Auth.php';

// if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
//     header("Location: ../success.php");
//     exit;
// }

$db = Connection::getInstance();
$auth = new Auth($db);

if (isset($_POST['email']) && isset($_POST['password'])) {
    if ($auth->login($_POST['email'], $_POST['password'])) {
        header("Location: ../success.php");
        exit;
    } else {
        echo 'Invalid username or password.';
    }
}

// if ($auth->isLoggedIn()) {
//     echo 'User is logged in.';
// }else {
//     echo 'User is not logged in.';
// }

if (isset($_POST['logout'])) {
    $auth->logout();
    header("Location: ../index.php");
    exit;
}


?>
