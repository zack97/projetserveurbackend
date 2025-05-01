<?php
session_start();

require_once '../models/User.php'; 

$userModel = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $rememberMe = isset($_POST['remember']); 

    $loginResult = $userModel->login(['email' => $email, 'password' => $password]);

    if ($loginResult === true) {
        if ($rememberMe) {
            $cookieValue = base64_encode($email . '|' . $password);
            setcookie('remember_me', $cookieValue, time() + 3600 * 24 * 3, '/'); // Durée : 3 jours
        }

        header("Location: /index.php");
        exit();
    } else {
        $errorMessage = "Invalid email or password.";
    }
}

include_once './loginPage.php';

