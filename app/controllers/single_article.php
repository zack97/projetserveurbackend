<?php
session_start();

require_once './body.php';
require_once '../../controllers/ArticleController.php';
require_once "../models/ArticleModel.php";

// Charger le CSS et le header
generatehead('../../assets/css/main.css');
generateHeader('../../media/news.jpg', 'log_in.php');
generatenav('recherche.php');

// Récupérer l'ID de l'article depuis l'URL
$articleId = $_GET['id'] ?? null;

if (!$articleId) {
    echo "ID de l'article invalide.";
    exit;
}



// Appel du contrôleur pour récupérer l'article
$articleController = new ArticleController();
$article = $articleController->getArticleById($articleId);

if (!$article) {
    echo "Article introuvable.";
    exit;
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title_art']); ?></title>
</head>
<body>
    <div class="container mt-3">
        <h1><?php echo htmlspecialchars($article['title_art']); ?></h1>
        <p><small>Publié le <?php echo htmlspecialchars($article['date_art']); ?></small></p>

        <?php if (!empty($article['image_art'])) { ?>  
            <img src="<?php echo htmlspecialchars($article['image_art']); ?>" alt="Image de l'article" class="img-fluid mb-3"> 
        <?php } ?>

        <p><?php echo nl2br(htmlspecialchars($article['content_art'])); ?></p>

    </div>

<?php
generatefooter('../../media/res.jpg');
generateboottraap(); 
?>

