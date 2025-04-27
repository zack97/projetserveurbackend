<?php
session_start();
require_once '../../database/connection.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php');
    exit();
}

$articles = $pdo->query("SELECT * FROM articles")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Manage Articles</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Title</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($articles as $article): ?>
    <tr>
        <td><?php echo htmlspecialchars($article['title_art']); ?></td>
        <td>
            <a href="edit_article.php?id=<?php echo $article['id_art']; ?>" class="btn btn-primary">Edit</a>
            <form action="delete_article.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                <input type="hidden" name="article_id" value="<?php echo $article['id_art']; ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
