<?php 
session_start(); 

require_once './app/controllers/body.php';
require_once './app/controllers/ads.php';
require_once './controllers/ArticleController.php';

// Générer l'en-tête, le header, la nav, la pub (tout fixe)
generatehead('../assets/css/main.css');

?>

<!-- Zone où les contenus vont changer dynamiquement -->
<div id="main-content">
    <?php
    generateHeader(
        'index.php', 
        './database/press_media/media/news.jpg',
        './app/controllers/admin/users_admin.php',
        './app/controllers/admin/articles_admin.php',
        './app/controllers/log_in.php',
        './app/controllers/logout.php',
        './favorites_list.php'
    );
    generatenav('./app/controllers/recherche.php');
    publicite();
    // Chargement initial d'articles (premier affichage)
    $controller = new ArticleController();
    $controller->showArticles();

    // Footer toujours visible
    generatefooter();
    generateboottraap();
    ?>
</div>

<?php

?>

<!-- SCRIPT AJAX -->
<script>
// 1. Fonction pour charger le contenu via AJAX
function loadContent(url) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            document.getElementById('main-content').innerHTML = html;
            rebindLinks(); // Rebinder les nouveaux liens
        })
        .catch(error => console.error('Erreur AJAX :', error));
}

// 2. Fonction pour intercepter les clics sur <a> AJAX
function rebindLinks() {
    document.querySelectorAll('a.ajax-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Empêcher le comportement normal
            const url = this.getAttribute('href');
            loadContent(url);
        });
    });
}

// 3. Initialisation au chargement
document.addEventListener('DOMContentLoaded', () => {
    rebindLinks();
});
</script>
