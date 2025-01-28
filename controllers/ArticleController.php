<?php

require_once __DIR__ . '/../models/ArticleModel.php';

class ArticleController {
    public function showArticles() {
        $latestArticles = ArticleModel::getArticles();
        $featuredArticles = ArticleModel::getFeaturedArticles();
        
        require_once __DIR__ . '/../views/articles.php';
    }

    
    public function getArticleById($id) {
        $article = new ArticleModelclass();
        return $article->getArticleById($id);
    }
}
?>
