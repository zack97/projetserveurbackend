<?php
require_once __DIR__ . '/../../config/database.php';

class ArticleModelClass {
    public static function getArticles() {
        try {
            $conn = Database::connect();
            $stmt = $conn->query("SELECT * FROM t_article");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des articles : " . $e->getMessage());
        }
    }

    public static function getArticleById($id) {
        try {
            $conn = Database::connect();
            $stmt = $conn->prepare("SELECT * FROM t_article WHERE id_art = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération de l'article : " . $e->getMessage());
        }
    }
}
?>
