<?php
session_start();
require_once './app/controllers/body.php';
require_once './app/models/User.php'; 

$userModel = new User();

if (!isset($_SESSION['user'])) {
    echo "You must be logged in to view your favorites.";
    exit;
}

$userId = $_SESSION['user']['id'];

generatehead('../assets/css/main.css');
generateHeader('./database/press_media/media/news.jpg', './views/controllers/log_in.php', './views/controllers/logout.php', './favorites_list.php');
generatenav('./app/controllers/recherche.php');

function favori($userId) {
    global $userModel;

    $stmt = $userModel->getDb()->prepare("SELECT t_article.* 
                                          FROM t_article
                                          JOIN favorites f ON t_article.id_art = f.article_id
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
        
        <?php foreach ($favoriteArticles as $article) {
                $fullContent = htmlspecialchars($article['content_art']);
                $words = explode(' ', strip_tags($article['content_art']));
                $shortContent = htmlspecialchars(implode(' ', array_slice($words, 0, 20))) . '...';
                ?>  
            <article class="mb-3">
                <div>
                    <small>Published on <?php echo htmlspecialchars($article['date_art']); ?></small>
                </div>
                <?php if (!empty($article['image_art'])) { ?>
                    <img src="./database/press_media/media/<?php echo htmlspecialchars($article['image_art']); ?>" alt="image">
                <?php } ?>
                <a href="./app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id_art']); ?>">
                    <h3 class="h6"><?php echo htmlspecialchars($article['title_art']); ?></h3>
                </a>
                <div class="article-content" style="margin-bottom: 1rem;">
                    <p>
                        <span class="short-content"><?php echo $shortContent; ?></span>
                        <span class="full-content" style="display: none;"><?php echo $fullContent; ?></span>
                    </p>
                    <button class="toggle-btn btn btn-sm btn-primary" onclick="toggleContent(this)">
                        Show more
                    </button>
                </div>
               
                <form action="./remove_favorite.php" method="POST" style="display:inline;">
                    <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($article['id_art']); ?>">
                    <button type="submit" class="btn btn-sm btn-danger">Remove from favorites</button>
                </form>
            </article>
        <?php } ?>
    </div> 
    
    <script>
        function toggleContent(button) {
            const container = button.closest('.article-content');
            const shortContent = container.querySelector('.short-content');
            const fullContent = container.querySelector('.full-content');

            const isShortVisible = shortContent.style.display !== 'none';

            shortContent.style.display = isShortVisible ? 'none' : 'inline';
            fullContent.style.display = isShortVisible ? 'inline' : 'none';
            button.textContent = isShortVisible ? 'Show less' : 'Show more';
        }

    </script>
    <?php
   
}

favori($userId);

generatefooter();
generateboottraap();
?>
