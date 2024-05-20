<?php

session_start();

require_once '../class/Connection.php';
require_once '../class/Auth.php';

$db = Connection::getInstance();
$auth = new Auth($db);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $errors = [];
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $auth->register($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"]);
    } else {
        foreach ($errors as $error) {
            echo "$error<br>";
        }
    }
}

?>