<?php
session_start();
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $isLoggedIn = $user->login($_POST);

    if ($isLoggedIn) {
        $_SESSION['user'] = $isLoggedIn;
        header("Location: /index.php");
        exit;
    } else {
        echo "Erreur : les identifiants sont incorrects.";
    }
}
