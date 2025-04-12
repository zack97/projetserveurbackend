<?php
session_start();
require_once './app/controllers/body.php';
require_once './app/controllers/ads.php';
require_once './controllers/ArticleController.php';
require_once './app/controllers/body.php';  


// Affiche le head + header + nav
generatehead('../assets/css/main.css');
?>

<!-- Contenu qui changera dynamiquement -->
<div id="content">
    <?php
    generateHeader('./database/press_media/media/news.jpg', './app/controllers/log_in.php', './app/controllers/logout.php', './favorites_list.php');
    generatenav('./app/controllers/recherche.php');
    publicite();
    $controller = new ArticleController();
    $controller->showArticles();
    generatefooter();
    generateboottraap();
    ?>
</div>

<?php

?>
