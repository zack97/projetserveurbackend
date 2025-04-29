<?php
session_start();
require_once '../../../config/database.php';

// Vérifie si l'utilisateur est un admin
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php');
    exit();
}

$pdo = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer l'article selon l'ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: articles_admin.php');
    exit();
}

$article_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM t_article WHERE id_art = ?");
$stmt->execute([$article_id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "Article not found.";
    exit();
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title_art'];
    $content = $_POST['content_art'];
    $date_pub = $_POST['date_art'];

    // Gestion de l'image
    if (!empty($_FILES['image_art']['name'])) {
        $imageName = uniqid() . '_' . $_FILES['image_art']['name'];
        move_uploaded_file($_FILES['image_art']['tmp_name'], '../../../database/press_media/media/' . $imageName);
    } else {
        $imageName = $article['image_art']; // Garde l'ancienne image
    }

    $update = $pdo->prepare("UPDATE t_article SET title_art = ?, content_art = ?, image_art = ?, date_art = ? WHERE id_art = ?");
    $update->execute([$title, $content, $imageName, $date_pub, $article_id]);

    header('Location: articles_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-center">Edit Article</h1>

    <form action="" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" name="title_art" class="form-control" value="<?php echo htmlspecialchars($article['title_art']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content:</label>
            <textarea name="content_art" class="form-control" rows="6" required><?php echo htmlspecialchars($article['content_art']); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Publication Date:</label>
            <input type="date" name="date_art" class="form-control" value="<?php echo htmlspecialchars($article['date_art']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image:</label><br>
            <?php if (!empty($article['image_art'])): ?>
                <img src="../../../database/press_media/media/<?php echo htmlspecialchars($article['image_art']); ?>" alt="Article Image" style="width: 150px; height: auto;">
            <?php else: ?>
                <em>No image</em>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload New Image:</label>
            <input type="file" name="image_art" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="articles_admin.php" class="btn btn-secondary ajax-link">Cancel</a>
    </form>
</div>

</body>
</html>
