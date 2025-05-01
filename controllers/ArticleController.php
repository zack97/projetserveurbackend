<?php

require_once __DIR__ . '/../models/ArticleModel.php';

class ArticleController {
    public function showArticles() {
        $latestArticles = ArticleModel::getArticles();  // Call static method
        // If you need featured articles, make sure to implement that in the model
        $featuredArticles = ArticleModel::getArticles();  // For now, let's assume you want all articles

        // Assuming you want to include a view, don't forget to call the view file:
        include __DIR__ . '/../views/articles.php';  // Add this to include the view for showing articles
    }

    public function getArticleById($id) {
        return ArticleModelClass::getArticleById($id);  // Correct way to call static method
    }
}
?>
