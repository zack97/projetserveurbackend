<?php 


session_start(); 

require_once './app/controllers/body.php';
require_once './app/controllers/ads.php';
require_once "./controllers/ArticleController.php";

generatehead('../assets/css/main.css');
generateHeader('','./database/press_media/media/news.jpg','./app/controllers/admin/users_admin.php' ,'./app/controllers/admin/articles_admin.php','./app/controllers/log_in.php', './app/controllers/logout.php', './favorites_list.php');
generatenav('./app/controllers/recherche.php');
publicite();

$controller = new ArticleController();
$controller->showArticles();

generatefooter();
generateboottraap();
?>