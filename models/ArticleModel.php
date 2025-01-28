<?php
require_once __DIR__ . '/../config/database.php';

class ArticleModel {
    public static function getArticles() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id, title, content, image, published, duree, source FROM articles ORDER BY published DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getFeaturedArticles() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id, title, content, image, published, duree, source FROM articles WHERE category = 'featured' ORDER BY published DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
