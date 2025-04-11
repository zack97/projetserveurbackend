<?php
session_start();
require_once '../../app/models/User.php'; 

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in to view your favorites.']);
    exit;
}

$userId = $_SESSION['user']['id']; 

try {
    $pdo = Database::connect(); 

    $stmt = $pdo->prepare("
        SELECT t_article.*
        FROM t_article
        INNER JOIN favorites ON favorites.article_id = t_article.id
        WHERE favorites.user_id = :user_id
    ");
    $stmt->execute([':user_id' => $userId]);

    $favoriteArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($favoriteArticles) {
        echo '<h2>Your Favorite Articles</h2>';
        echo '<ul>';
        foreach ($favoriteArticles as $article) {
            echo '<li>';
            echo '<strong>' . htmlspecialchars($article['title']) . '</strong><br>';
            echo 'Published on: ' . htmlspecialchars($article['published']);
            echo '<p>' . htmlspecialchars($article['content']) . '</p>';
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No favorite articles found.</p>';
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'An error occurred while fetching favorite articles.']);
    error_log($e->getMessage()); 
}
?>
