<?php

require_once './app/models/Article.php'; 

class ArticleController
{
    // Method to fetch all articles
    public function getAllArticles()
    {
        return Article::getAllArticles(); 
    }
}

