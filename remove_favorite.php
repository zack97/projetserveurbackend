<?php
session_start();
require_once './app/models/User.php'; // Inclure le modèle User pour interagir avec la base de données

// Initialiser la classe User
$userModel = new User();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "You must be logged in to remove from favorites.";
    exit;
}

if (isset($_POST['article_id'])) {
    $articleId = $_POST['article_id'];
    $userId = $_SESSION['user']['id'];  // ID de l'utilisateur connecté

    // Supprimer l'article des favoris
    $stmt = $userModel->getDb()->prepare("DELETE FROM favorites WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([':user_id' => $userId, ':article_id' => $articleId]);

    echo "<script type='text/javascript'>
            window.location.href = '/favorites_list.php';
      </script>";
    exit();
}
?>
