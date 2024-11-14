<?php
session_start();
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();
    $isRegistered = $user->register($_POST);

    if ($isRegistered) {
        $_SESSION['user'] = $isRegistered;
        header("Location: /index.php");
        exit;
    } else {
        echo "Erreur : l'inscription a échoué.";
    }
}
