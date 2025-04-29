<?php
session_start();
require_once '../../config/database.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit();
}

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['user']['id'];

    // Récupérer l'ancienne image de profil
    $stmt = $pdo->prepare("SELECT profile_image FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['profile_image']) {
        $filePath = '../../app/controllers/' . $user['profile_image'];
        
        // Supprimer physiquement le fichier si il existe
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Mettre à jour la base de données pour enlever l'image
    $update = $pdo->prepare("UPDATE users SET profile_image = NULL WHERE id = ?");
    $update->execute([$userId]);

    // Mettre à jour la session
    $_SESSION['user']['profile_image'] = null;

    $_SESSION['success_message'] = "Profile image deleted successfully.";
    header('Location: ../../index.php'); // Redirige vers le profil (ajuste le chemin selon ton projet)
    exit();
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error deleting profile image: " . $e->getMessage();
    header('Location: ../../index.php');
    exit();
}
