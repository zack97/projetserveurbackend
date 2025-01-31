<?php
session_start();
require_once './app/controllers/body.php';
require_once './app/models/User.php'; // Inclure la classe User pour la gestion des utilisateurs

// Initialiser la classe User
$userModel = new User();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "You must be logged in to view your favorites.";
    exit;
}

// Récupérer l'ID de l'utilisateur connecté
$userId = $_SESSION['user']['id'];

generatehead('../assets/css/main.css');
generateHeader('./media/news.jpg', './views/controllers/log_in.php', './views/controllers/logout.php', './favorites_list.php');
generatenav('./app/controllers/recherche.php');

// Fonction pour afficher les articles favoris
function favori($userId) {
    global $userModel;

    // Charger les articles favoris de la base de données
    $stmt = $userModel->getDb()->prepare("SELECT a.* FROM articles a 
                                          JOIN favorites f ON a.id = f.article_id
                                          WHERE f.user_id = :user_id");
    $stmt->execute([':user_id' => $userId]);
    $favoriteArticles = $stmt->fetchAll();

    if (empty($favoriteArticles)) {
        echo "No articles in your favorites.";
        return;
    }

    ?>
    <div class="container mt-3">
        <h1>Your Favorite Articles</h1>
        <?php foreach ($favoriteArticles as $article) { ?>
            <article class="mb-3">
                <div>
                    <small>Published on <?php echo htmlspecialchars($article['published']); ?></small>
                </div>
                <?php if (!empty($article['image'])) { ?>
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="image" class="mr-2 image-size">
                <?php } ?>
                <a href="View/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                    <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                </a>
                <p><?php echo htmlspecialchars($article['content']); ?></p>
                <small>Source: <?php echo htmlspecialchars($article['source']); ?></small>

                <form action="./remove_favorite.php" method="POST" style="display:inline;">
                    <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($article['id']); ?>">
                    <button type="submit" class="btn btn-sm btn-danger">Remove from favorites</button>
                </form>
            </article>
        <?php } ?>
    </div>
    <?php
}

// Afficher les articles favoris de l'utilisateur
favori($userId);

generatefooter();
generateboottraap();
?>
