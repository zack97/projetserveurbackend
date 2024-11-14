<?php
// public/index.php

require_once './config/config.php';
require_once './app/controllers/ArticleController.php';

$controller = new ArticleController($pdo);
$articles = $controller->getAllArticles();
include './app/views/index.php';
?>
