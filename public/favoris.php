<?php
session_start();
require_once '../config/config.php'; 

// Vérifiez que la connexion à la base de données est correcte
if (!isset($pdo)) {
    die('Erreur de connexion à la base de données.');
}

if (!isset($_SESSION['user'])) {
    header("Location: /app/views/user.php");
    exit;
}

$userId = $_SESSION['user']['id'];
echo "User ID: " . $userId; // Debugging line

$stmt = $pdo->prepare("SELECT articles.* FROM articles INNER JOIN favoris ON articles.id = favoris.article_id WHERE favoris.user_id = ?");
$stmt->execute([$userId]);
$favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Mes Favoris</title>
</head>
<body>
    <h2>Mes Articles Favoris</h2>
    <ul>
        <?php foreach ($favoris as $favori): ?>
            <li>
                <h3><?php echo htmlspecialchars($favori['title']); ?></h3>
                <p><?php echo htmlspecialchars($favori['content']); ?></p>
                <button onclick="supprimerFavori(<?php echo $favori['id']; ?>)">Supprimer des favoris</button>
            </li>
        <?php endforeach; ?>
    </ul>

    <script>
        function ajouterAuxFavoris(articleId) {
            fetch('/app/controllers/ajouter_favori.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'article_id=' + articleId
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);  
                alert(data);       
            })
            .catch(error => console.error('Error:', error)); 
        }
   </script>

</body>
</html>
