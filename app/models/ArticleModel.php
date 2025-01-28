<?php
require_once __DIR__ . '/../../config/database.php';

class ArticleModelclass {
    public static function getArticles() {
        try {
            $conn = Database::connect();
            $stmt = $conn->query("SELECT * FROM articles WHERE category = 'latest' ORDER BY published DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des articles : " . $e->getMessage());
        }
    }

    public static function getFeaturedArticles() {
        try {
            $conn = Database::connect();
            $stmt = $conn->query("SELECT * FROM articles WHERE category = 'featured' ORDER BY published DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des articles mis en avant : " . $e->getMessage());
        }
    }

    // Ajout de la méthode getArticleById()
    public static function getArticleById($id) {
        try {
            $conn = Database::connect();
            $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'article : " . $e->getMessage());
        }
    }
}
?>
