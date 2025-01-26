<?php
// controllers/LoginController.php

require_once __DIR__ . '/../models/User.php';

class LoginController {
    public function authenticate($email, $password) {
        $userModel = new User();
        $user = $userModel->login($email, $password);

        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            header("Location: /views/login_success.php");
            exit();
        } else {
            return "Email ou mot de passe incorrect.";
        }
    }
}
?>
