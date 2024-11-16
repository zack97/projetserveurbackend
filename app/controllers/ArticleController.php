<?php
// app/controllers/ArticleController.php

require_once './app/models/Article.php'; // Import the Article model

class ArticleController
{
    // Method to fetch all articles
    public function getAllArticles()
    {
        return Article::getAllArticles(); // Call the static method of the Article model
    }
}

