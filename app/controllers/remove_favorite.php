<?php

/**************************
 * Ce controller gère la suppression d'article favoris
 * 
 * ********************************************************************************** */




session_start();

// On vérifie si l'article ID est présent dans les données POST
if (isset($_POST['article_id'])) {
    $articleId = $_POST['article_id'];

    // On vérifie si l'article existe dans les favoris
    if (in_array($articleId, $_SESSION['favorites'])) {
        // On supprime l'article des favoris
        $_SESSION['favorites'] = array_diff($_SESSION['favorites'], [$articleId]);
        $_SESSION['message'] = 'Article supprimé des favoris.';

    } else {
        // Message d'erreur si l'article n'est pas dans les favoris
        $_SESSION['message'] = 'Cet article n\'est pas dans vos favoris.';
    }

    // On se redirige vers la page des favoris, je ne pas réussi a utilisé header() <- Zacharie
    echo "<script type='text/javascript'>
            window.location.href = '/favorites_list.php';
      </script>";
    exit();
} else {
    // Si aucune donnée POST n'est envoyée, on reste sur la page des favoris
    echo "<script type='text/javascript'>
    window.location.href = '/favorites_list.php';
     </script>";
    exit();
}
