<?php
session_start();
require_once '../../../config/database.php';

// Vérifie que c'est un admin connecté
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php');
    exit();
}

// Vérifie qu'on a bien reçu un ID
if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    $userId = (int) $_POST['user_id'];

    try {
        // Connexion PDO
        $pdo = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Supprimer les favoris liés à cet utilisateur d'abord (clé étrangère potentielle)
        $deleteFavorites = $pdo->prepare("DELETE FROM favorites WHERE user_id = ?");
        $deleteFavorites->execute([$userId]);

        // Supprimer ensuite l'utilisateur
        $deleteUser = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $deleteUser->execute([$userId]);

        // Redirection après succès
        $_SESSION['success_message'] = "User deleted successfully.";
        header('Location: users_admin.php');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur
        $_SESSION['error_message'] = "Error deleting user: " . $e->getMessage();
        header('Location: users_admin.php');
        exit();
    }
} else {
    // Si pas d'ID valide reçu
    $_SESSION['error_message'] = "Invalid user ID.";
    header('Location: users_admin.php');
    exit();
}
