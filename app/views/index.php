<?php
session_start(); // Start the session to access user data
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>France24 - Accueil</title>
</head>
<body>
    <header>
        <img src="/media/fr24_icon.jpg" alt="icon_france24"  >
        <nav>
            <a href="/">Accueil</a>
            <a href="/app/views/apropos.php">À Propos</a>
            <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
                <span>Bonjour, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></span>
                <a href="/public/favoris.php" class="logout-button" >Mes Favoris</a>
                <a href="/logout.php" class="logout-button">Se déconnecter</a>
            <?php else: ?>
                <a href="/app/views/user.php">Identifiez-vous</a>
            <?php endif; ?>
        </nav>

    </header>
    <main>
        <h2 class="main-h2">Articles</h2>
        <div class="first-article">
            <?php $firstArticle = $articles[0]; ?>
            <div class="first-article-right">
                <img src="/<?php echo htmlspecialchars($firstArticle['image_path']); ?>" alt="<?php echo htmlspecialchars($firstArticle['title']); ?>" >
                <h2><a href="article.php?id=<?php echo $firstArticle['id']; ?>"><?php echo $firstArticle['title']; ?></a></h2>
                <p><strong>Auteur :</strong> <?php echo htmlspecialchars($firstArticle['author']); ?></p>
                <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($firstArticle['date_published']); ?></p>
                <p><?php echo htmlspecialchars($firstArticle['content']); ?></p>
                <button class="favorite-button" data-article-id="<?php echo $firstArticle['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle['id']; ?>)">Ajouter aux favoris</button>

            </div>
            <div class="first-article-left">
                <div class="left1">
                    <?php $firstArticle = $articles[1]; ?>
                    <img src="/<?php echo htmlspecialchars($firstArticle['image_path']); ?>" alt="<?php echo htmlspecialchars($firstArticle['title']); ?>" >
                    <div>
                        <h2><a href="article.php?id=<?php echo $firstArticle['id']; ?>"><?php echo $firstArticle['title']; ?></a></h2>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($firstArticle['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($firstArticle['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($firstArticle['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle['id']; ?>)">Ajouter aux favoris</button>
                    </div>           
                </div>
                <hr>
                <div class="left2">
                    <?php $firstArticle = $articles[2]; ?>
                    <img src="/<?php echo htmlspecialchars($firstArticle['image_path']); ?>" alt="<?php echo htmlspecialchars($firstArticle['title']); ?>">
                    <div>
                        <h2><a href="article.php?id=<?php echo $firstArticle['id']; ?>"><?php echo $firstArticle['title']; ?></a></h2>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($firstArticle['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($firstArticle['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($firstArticle['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle['id']; ?>)">Ajouter aux favoris</button>
                        </div>          
                </div>
                <hr>
                <div class="left3">
                    <?php $firstArticle = $articles[3]; ?>
                    <img src="/<?php echo htmlspecialchars($firstArticle['image_path']); ?>" alt="<?php echo htmlspecialchars($firstArticle['title']); ?>" >
                    <div>
                        <h2><a href="article.php?id=<?php echo $firstArticle['id']; ?>"><?php echo $firstArticle['title']; ?></a></h2>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($firstArticle['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($firstArticle['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($firstArticle['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle['id']; ?>)">Ajouter aux favoris</button>
                        </div>          
                </div>
            </div>
        
        </div>

        <div class="articles-ul">
            <ul >
                <?php foreach (array_slice($articles, 4, 5) as $article): ?>
                    <li class="li1">
                    <img src="/<?php echo htmlspecialchars($article['image_path']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="img1">
                      <div>
                        <a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($article['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($article['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($article['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle['id']; ?>)">Ajouter aux favoris</button>
                        </div>
                        
                    </li>
                    <hr class="hr_link">
                <?php endforeach; ?>
            </ul>
           <hr>
            <ul>
                <?php foreach (array_slice($articles, 5) as $article): ?>
                    <li class="li2">
                      <img src="/<?php echo htmlspecialchars($article['image_path']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="img1">
                      <div>
                        <a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($article['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($article['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($article['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle['id']; ?>)">Ajouter aux favoris</button>
                        </div>                  
                    </li>
                    <hr class="hr_link">
                <?php endforeach; ?>
            </div>
           
        </div>
    </main>
    <footer>
        <p>© 2024 France24. Tous droits réservés.</p>
    </footer>


    <script>
        function ajouterAuxFavoris(articleId) {
            fetch('/app/controllers/ajouter_favori.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'article_id=' + articleId
            })
            .then(response => response.text())
            .then(data => alert(data));

            console.log(data)
        }
   </script>
</body>
</html>





