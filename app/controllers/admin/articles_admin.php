<?php
session_start();
require_once '../../../config/database.php'; 
require_once '../body.php';


// Vérifie si l'utilisateur est un admin
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php');
    exit();
}

$pdo = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer tous les articles
$articles = $pdo->query("SELECT * FROM t_article")->fetchAll(PDO::FETCH_ASSOC);


generatehead('../../../assets/css/main.css');
generateHeader('../../../index.php','../../../database/press_media/media/news.jpg', './users_admin.php','' , '../log_in.php', '../logout.php', '../../../favorites_list.php');
generatenav('../recherche.php');
?>


<div class="container mt-5 table-hover">
    <h1 class="mb-4 text-center">Manage Articles</h1>

    <table class="table table-bordered ">
        <thead class="text-center" style="background-color: lightblue;">
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Publication</th>
                <th style="width: 200px;">Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle text-center ">
            <?php foreach ($articles as $article): ?>
            <tr >
                <td><?php echo htmlspecialchars($article['title_art']); ?></td>
                <td>
                    <?php if (!empty($article['image_art'])): ?>
                        <img src="../../../database/press_media/media/<?php echo htmlspecialchars($article['image_art']); ?>" alt="Article Image" style=" width: 100px; height: auto; object-fit: cover">
                    <?php else: ?>
                        <em>No image</em>
                    <?php endif; ?>
                </td>
                <td>
                    <?php 
                        if (!empty($article['date_art'])) {
                            echo htmlspecialchars(date("d-m-Y", strtotime($article['date_art'])));
                        } else {
                            echo '<em>No Date</em>';
                        }
                    ?>
                </td>
                <td>
                    <a href="edit_article.php?id=<?php echo $article['id_art']; ?>" class="btn btn-warning btn-sm mb-1 ajax-link">Edit</a>
                    <form action="delete_article.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this article?');">
                        <input type="hidden" name="article_id" value="<?php echo $article['id_art']; ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
generatefooter('../../../database/press_media/media/news.jpg');
generateboottraap();
?>
