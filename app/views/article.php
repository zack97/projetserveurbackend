<?php
// public/article.php

require_once '../config/config.php';
require_once '../app/controllers/ArticleController.php';

$controller = new ArticleController($pdo);
$article = $controller->getArticleById($_GET['id']);
include '../app/views/article.view.php';
