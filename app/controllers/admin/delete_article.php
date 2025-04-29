<?php
session_start();
require_once '../../../config/database.php';

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php');
    exit();
}

// Vérifier si l'ID de l'article est fourni
if (!isset($_POST['article_id']) || empty($_POST['article_id'])) {
    header('Location: articles_admin.php');
    exit();
}

$article_id = (int)$_POST['article_id']; // sécuriser en int

try {
    // Connexion PDO
    $pdo = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer le nom de l'image de l'article
    $stmt = $pdo->prepare("SELECT image_art FROM t_article WHERE id_art = ?");
    $stmt->execute([$article_id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        // Si une image existe, la supprimer du dossier
        if (!empty($article['image_art'])) {
            $image_path = '../../../database/press_media/media/' . $article['image_art'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        // Supprimer l'article de la base de données
        $deleteStmt = $pdo->prepare("DELETE FROM t_article WHERE id_art = ?");
        $deleteStmt->execute([$article_id]);
    }

    header('Location: articles_admin.php');
    exit();

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
