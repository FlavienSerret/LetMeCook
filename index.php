<?php
// index.php

require_once __DIR__ . '/Controller/LoginController.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginController = new LoginController();
    $error = $loginController->authenticate($email, $password);
}

require __DIR__ . '/view/php/login.php';
?>
