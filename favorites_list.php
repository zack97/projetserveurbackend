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
generateHeader('./index.php','./database/press_media/media/news.jpg','./app/controllers/admin/users_admin.php','./app/controllers/admin/articles_admin.php', './app/controllers/log_in.php', './app/controllers/logout.php', './favorites_list.php');
generatenav('./app/controllers/recherche.php');

function favori($userId) {
    global $userModel;
    $isDark = isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark';


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
    <div class="container1 mt-3" style="color: #333; ">
        <h1>Favorite Articles</h1>
        
        <div class="header-row">
            <div>Date</div>
            <div>Image</div>
            <div>Title</div>
            <div>Content</div>
            <div>Actions</div>
        </div>

    <?php foreach ($favoriteArticles as $article) {
        $fullContent = htmlspecialchars($article['content_art']);
        $words = explode(' ', strip_tags($article['content_art']));
        $shortContent = htmlspecialchars(implode(' ', array_slice($words, 0, 20))) . '...';
    ?>  
        <article class="mb-3" style=" <?php echo $isDark ? 'bg-dark' : ''; ?>"> 
            <div>
                <small><?php echo htmlspecialchars($article['date_art']); ?></small>
            </div>

            <div>
                <?php if (!empty($article['image_art'])) { ?>
                    <img src="./database/press_media/media/<?php echo htmlspecialchars($article['image_art']); ?>" alt="image">
                <?php } ?>
            </div>

            <div>
                <a href="./app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id_art']); ?>" class="ajax-link">
                    <h3 class="h6"><?php echo htmlspecialchars($article['title_art']); ?></h3>
                </a>
            </div>

            <div class="article-content">
                <p>
                    <span class="short-content"><?php echo $shortContent; ?></span>
                    <span class="full-content" style="display: none;"><?php echo $fullContent; ?></span>
                </p>
            </div>

            <div>
                <form action="./remove_favorite.php" method="POST" style="display:inline;">
                    <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($article['id_art']); ?>">
                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                </form>
            </div>
        </article>
    <?php } ?>
</div>
<?php
   
}

favori($userId);

generatefooter();
generateboottraap();
?>
