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

echo "voici l'article numero $articleId";


// Appel du contrôleur pour récupérer l'article
$articleController = new ArticleController();
$article = $articleController->getArticleById($articleId);

if (!$article) {
    echo "Article introuvable.";
    exit;
}

$minReadingTime = 1;
$maxReadingTime = 20;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
</head>
<body>
    <div class="container mt-3">
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <p><small>Publié le <?php echo htmlspecialchars($article['published']); ?></small></p>

        <?php if (!empty($article['image'])) { ?>  
            <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Image de l'article" class="img-fluid mb-3"> 
        <?php } ?>

        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        <small>Source : <?php echo htmlspecialchars($article['source']); ?></small>

        <!-- Slider de lecture -->
        <div class="mt-4">
            <label for="readingSlider">Temps de lecture :</label>
            <input type="range" id="readingSlider" min="<?php echo $minReadingTime; ?>" max="<?php echo $maxReadingTime; ?>" value="<?php echo $minReadingTime; ?>" class="form-range">
            <p>Temps restant : <span id="readingTime"><?php echo $maxReadingTime; ?></span> secondes</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('readingSlider');
            const readingTimeDisplay = document.getElementById('readingTime');

            slider.addEventListener('input', function () {
                readingTimeDisplay.textContent = slider.value;
                if (slider.value == slider.max) {
                    window.location.href = '../index.php';
                }
            });
        });
    </script>

<?php
generatefooter('../../media/res.jpg');
generateboottraap(); 
?>
</body>
</html>
