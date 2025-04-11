<?php





session_start();

if (isset($_POST['article_id'])) {
    $articleId = $_POST['article_id'];

    if (in_array($articleId, $_SESSION['favorites'])) {

        $_SESSION['favorites'] = array_diff($_SESSION['favorites'], [$articleId]);
        $_SESSION['message'] = 'Article supprimé des favoris.';

    } else {
        $_SESSION['message'] = 'Cet article n\'est pas dans vos favoris.';
    }

    echo "<script type='text/javascript'>
            window.location.href = '/favorites_list.php';
      </script>";
    exit();
} else {
    echo "<script type='text/javascript'>
    window.location.href = '/favorites_list.php';
     </script>";
    exit();
}
