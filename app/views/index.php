<?php
session_start(); 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/main_resp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>France24 - Accueil</title>
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
                    <?php $firstArticle1 = $articles[2]; ?>
                    <img src="/<?php echo htmlspecialchars($firstArticle1['image_path']); ?>" alt="<?php echo htmlspecialchars($firstArticle1['title']); ?>">
                    <div>
                        <h2><a href="article.php?id=<?php echo $firstArticle1['id']; ?>"><?php echo $firstArticle1['title']; ?></a></h2>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($firstArticle1['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($firstArticle1['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($firstArticle1['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle1['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle1['id']; ?>)">Ajouter aux favoris</button>
                        </div>          
                </div>
                <hr>
                <div class="left3">
                    <?php $firstArticle2 = $articles[3]; ?>
                    <img src="/<?php echo htmlspecialchars($firstArticle2['image_path']); ?>" alt="<?php echo htmlspecialchars($firstArticle2['title']); ?>" >
                    <div>
                        <h2><a href="article.php?id=<?php echo $firstArticle2['id']; ?>"><?php echo $firstArticle2['title']; ?></a></h2>
                        <p><strong>Auteur :</strong> <?php echo htmlspecialchars($firstArticle2['author']); ?></p>
                        <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($firstArticle2['date_published']); ?></p>
                        <p><?php echo htmlspecialchars($firstArticle2['content']); ?></p>
                        <button class="favorite-button" data-article-id="<?php echo $firstArticle2['id']; ?>" onclick="ajouterAuxFavoris(<?php echo $firstArticle2['id']; ?>)">Ajouter aux favoris</button>
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
            .then(data => {
        if (data.success) {
            alert(data.message); // Succès
        } else {
            alert(data.message); // Erreur côté serveur
        }
    })}


        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.querySelector('header div'); 
            const nav = document.querySelector('nav'); 

            hamburger.addEventListener('click', () => {
                nav.classList.toggle('show-nav'); 
            });
        });

   </script>
</body>
</html>





