<?php
session_start(); // Start the session to access user data
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/main_resp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>France24 - Apropos</title>
</head>
<body>
<header>
        <img src="/media/fr24_icon.jpg" alt="icon_france24"  >
        <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
           <span class="name_display">Welcome, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></span> 
           <hr class="hrhr">
           <h6><?php echo htmlspecialchars($_SESSION['user']['country']);?></h6>
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
    <main class="apropos-main">
       <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
         <h2><?php echo htmlspecialchars($_SESSION['user']['first_name']); ?> Bienvenue sur France24 </h2>
         <?php else: ?>
            <h2>Bienvenue sur France24</h2>
       <?php endif; ?>
      <div>
         <p>
           Votre source incontournable d'informations fiables et diversifiées. <br> <br> <hr>
           Nous sommes un média indépendant dédié à vous offrir des actualités précises, pertinentes et accessibles, où que vous soyez. <br> <br>
           Notre mission est de vous tenir informé des événements qui façonnent le monde,  en vous proposant des analyses approfondies,  
           des reportages exclusifs et des opinions variées. Que ce soit la politique, l'économie, la culture, le sport ou les dernières innovations technologiques, 
           nous couvrons un large éventail de sujets pour répondre à toutes vos interrogations et enrichir vos connaissances.

           <br>Chez France24, nous croyons en l'importance d'un journalisme transparent et éthique. 
           Nos journalistes et rédacteurs s'engagent à respecter les standards les plus élevés pour garantir une information de qualité.

           Rejoignez notre communauté de lecteurs engagés et découvrez chaque jour un contenu conçu pour éveiller votre curiosité et nourrir votre réflexion.

           Merci de faire de France24 votre partenaire d'information privilégié. Ensemble, faisons vivre l'actualité autrement.
      </p>
      </div>
     
    </main>
    <footer>
        <p>© 2024 France24. Tous droits réservés.</p>
    </footer>

    <script>
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





