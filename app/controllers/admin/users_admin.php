<?php
session_start();
require_once '../../../config/database.php'; 
require_once '../body.php';

// Vérifie que c'est un admin
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php');
    exit();
}

// Connexion PDO
$pdo = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupère tous les utilisateurs
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

// Génération de la page
generatehead('../../../assets/css/main.css');
generateHeader('../../../index.php','../../../database/press_media/media/news.jpg', '','./articles_admin.php' , '../log_in.php', '../logout.php', '../../../favorites_list.php');
generatenav('../recherche.php');
?>

<div class="user_admin">
   
    <h1>Manage Users</h1>

    <div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Favorites</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <div class="favorites-list">
                    <?php
                    // Récupération des favoris
                    $favorites = $pdo->prepare("SELECT a.id_art, a.title_art, a.image_art FROM favorites f JOIN t_article a ON f.article_id = a.id_art WHERE f.user_id = ?");
                    $favorites->execute([$user['id']]);
                    $favoriteArticles = $favorites->fetchAll(PDO::FETCH_ASSOC);

                    if ($favoriteArticles) {
                        $counter = 1;
                        foreach ($favoriteArticles as $fav) { ?> 
                            <div class="favorite-item">
                                <span class="favorite-counter"><?php echo $counter; ?>.</span>
                                <span class="favorite-id">[ID: <?php echo htmlspecialchars($fav['id_art']); ?>]</span>
                                <a class="favorite-link ajax-link" href="../../controllers/single_article.php?id=<?php echo htmlspecialchars($fav['id_art']); ?>">
                                    <?php echo htmlspecialchars($fav['title_art']); ?>
                                </a>
                                <?php if (!empty($fav['image_art'])): ?>
                                    <img class="favorite-image" src="../../../database/press_media/media/<?php echo htmlspecialchars($fav['image_art']); ?>" alt="<?php echo htmlspecialchars($fav['title_art']); ?>">
                                <?php else: ?>
                                    <em class="no-image">No image available</em>
                                <?php endif; ?>
                            </div>
                        <?php
                            $counter++;
                        }
                    } else {
                        echo "<span class='no-favorites'>No favorites.</span>";
                    }
                    ?>
                    </div>
                </td>
                <td>
                    <form action="delete_user.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="btn btn-danger">Delete User</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<?php
generatefooter('../../../database/press_media/media/news.jpg');
generateboottraap();
?>
