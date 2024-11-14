<?php
session_start();
require_once './config/config.php';

if (isset($_SESSION['user']) && isset($_POST['article_id'])) {
    $userId = $_SESSION['user']['id'];
    $articleId = (int)$_POST['article_id'];

    $stmt = $db->prepare("DELETE FROM favoris WHERE user_id = ? AND article_id = ?");
    $stmt->bind_param("ii", $userId, $articleId);
    
    if ($stmt->execute()) {
        echo "Article supprimé des favoris";
    } else {
        echo "Erreur lors de la suppression du favori";
    }
} else {
    echo "Vous devez être connecté pour supprimer des favoris.";
}
