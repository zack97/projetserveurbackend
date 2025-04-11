<?php 


session_start(); 

require_once './app/controllers/body.php';
require_once './app/controllers/ads.php';
require_once "./controllers/ArticleController.php";

generatehead('../assets/css/main.css');
generateHeader('./media/news.jpg', './app/controllers/log_in.php', './app/controllers/logout.php', './favorites_list.php');
generatenav('./app/controllers/recherche.php');
publicite();


$controller = new ArticleController();
$controller->showArticles();

generatefooter();
generateboottraap();
?>