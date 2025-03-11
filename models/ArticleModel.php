<?php
require_once __DIR__ . '/../config/database.php';

class ArticleModel {
    public static function getArticles() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id_art AS id, title_art AS title, content_art AS content, image_art AS image, date_art AS published, readtime_art AS duree, url_art AS source FROM t_article ORDER BY date_art DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getFeaturedArticles() {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT id_art AS id, title_art AS title, content_art AS content, image_art AS image, date_art AS published, readtime_art AS duree, url_art AS source FROM t_article WHERE fk_category_art = 'featured' ORDER BY date_art DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
