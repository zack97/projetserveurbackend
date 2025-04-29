<?php
session_start();

require_once './body.php';
require_once '../../controllers/ArticleController.php';
require_once "../models/ArticleModel.php";

// Charger le CSS et le header
generatehead('../../assets/css/main.css');
generateHeader('../../index.php','../../database/press_media/media/news.jpg', './admin/users_admin.php','./admin/articles_admin.php', './log_in.php', './logout.php','../../favorites_list.php');
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
    <style>
        .container.mt-3 {
    max-width: 900px;
    background-color: #fff;
    border-radius: 12px;
    padding: 2rem;
    margin: 2rem auto;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container.mt-3 h1 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #333;
    border-left: 5px solid #007bff;
    padding-left: 0.75rem;
}

.container.mt-3 p small {
    display: inline-block;
    margin-bottom: 1rem;
    color: #888;
    font-size: 0.9rem;
}

.container.mt-3 img.img-fluid {
    border-radius: 10px;
    max-height: 400px;
    object-fit: cover;
    width: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.container.mt-3 p {
    color: #444;
    line-height: 1.7;
    font-size: 1.05rem;
    margin-top: 1rem;
}

    </style>
</head>
<body>
    <div class="container mt-3">
        <h1><?php echo htmlspecialchars($article['title_art']); ?></h1>
        <p><small>Publié le <?php echo htmlspecialchars($article['date_art']); ?></small></p>

        <?php if (!empty($article['image_art'])) { ?>  
            <img src="../../database/press_media/media/<?php echo htmlspecialchars($article['image_art']); ?>" alt="Image de l'article" class="img-fluid mb-3"> 
        <?php } ?>

        <p><?php echo nl2br(htmlspecialchars($article['content_art'])); ?></p>

    </div>

<?php
generatefooter('../../media/res.jpg');
generateboottraap(); 
?>

