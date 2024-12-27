<?php
session_start();
require_once '../config/config.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: /app/views/user.php");
    exit;
}

$userId = $_SESSION['user']['id']; // ID de l'utilisateur connecté


// Récupère les articles favoris de l'utilisateur
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
<header>
        <img src="/media/fr24_icon.jpg" alt="icon_france24"  >
        <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
           <span class="name_display">Welcome, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></span> 
           <hr class="hrhr">
           <h6 class="h6"><?php echo htmlspecialchars($_SESSION['user']['country']);?></h6>
        <?php endif; ?>
        <div class="hamburger none_icon"><i class="fa-solid fa-bars"></i></div>
        <nav>
            <a href="/">Accueil</a>
            <a href="/app/views/apropos.php">À Propos</a>
            <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
                <span class="name-drop">Bonjour, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></span>
                <a href="/public/favoris.php" class="logout-button" >Mes Favoris</a>
                <a href="/logout.php" class="logout-button">Se déconnecter</a>
            <?php else: ?>
                <a href="/app/views/user.php">Identifiez-vous</a>
            <?php endif; ?>
        </nav>

    </header>
    <main style="height: 100vh;">

        <h2>Mes Articles Favoris</h2>
        <ul>
            <?php if (empty($favoris)): ?>
                <p>Vous n'avez aucun article dans vos favoris.</p>
                <?php echo $userId  ?>
            <?php else: ?>
                <?php foreach ($favoris as $favori): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($favori['title']); ?></h3>
                        <p><?php echo htmlspecialchars($favori['content']); ?></p>
                        <button onclick="supprimerFavori(<?php echo $favori['id']; ?>)">Supprimer des favoris</button>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </main>
   

    <footer>
        <p>© 2024 France24. Tous droits réservés.</p>
    </footer>

    <script>
        function supprimerFavori(articleId) {
            fetch('/app/controllers/ajouter_favori.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'article_id=' + articleId + '&action=delete'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur réseau : ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                alert(data);
                location.reload(); // Recharge la page pour mettre à jour la liste des favoris
            })
            .catch(error => console.error('Erreur :', error));
        }
</script>
</body>
</html>
