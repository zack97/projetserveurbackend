<?php
$articles = [
    ['id' => 1, 'title' => 'Les cyberattaques engendrées par la guerre russo-ukrainienne ont coûté deux milliards d\'euros aux organisations françaises en 2022', 'author' => 'Normand Roland', 'date_published' => '2022-12-01', 'content' => 'Deux milliards d’euros. C’est le coût colossal des cyberattaques réussies sur les systèmes d’information des organisations françaises, selon une estimation réalisée par le cabinet d’études économiques Asterès pour le compte du CRiP, une ...', 'image_path' => 'media/cyberattaque-france.jpg'],
    ['id' => 2, 'title' => 'Les cyberattaques engendrées par la guerre russo-ukrainienne ont coûté deux milliards d\'euros aux organisations françaises en 2022', 'author' => 'Normand Roland', 'date_published' => '2022-12-01', 'content' => 'Deux milliards d’euros. C’est le coût colossal des cyberattaques réussies sur les systèmes d’information des organisations françaises, selon une estimation réalisée par le cabinet d’études économiques Asterès pour le compte du CRiP, une ...', 'image_path' => 'media/cyberattaque-france.jpg'],
    ['id' => 3, 'title' => 'Climat : un rapport révèle des cas pour les écosystèmes marins', 'author' => 'Marine Leclerc', 'date_published' => '2022-11-20', 'content' => 'Selon une étude récente, les écosystèmes marins sont confrontés à des changements irréversibles en raison de la hausse des températures océaniques et de l\'acidification. Des experts recommandent une action immédiate pour limiter les émissions ...', 'image_path' => 'media/climat-ocean.jpg'],
    ['id' => 4, 'title' => 'Élections en France : la sécurité et le pouvoir d\'achat au cœur des débats', 'author' => 'Pierre Dupont', 'date_published' => '2023-02-15', 'content' => 'À l\'approche des élections, les candidats concentrent leurs efforts sur les questions de sécurité et de pouvoir d\'achat. De nombreux citoyens expriment des préoccupations sur l\'augmentation du coût de la vie et le manque de mesures concrètes pour ...', 'image_path' => 'media/elections-france.jpg'],
    ['id' => 5, 'title' => 'Découverte archéologique : un ancien temple égyptien dévoilé', 'author' => 'Lina Massri', 'date_published' => '2023-01-05', 'content' => 'Une équipe d\'archéologues a récemment découvert les ruines d\'un ancien temple égyptien, enfoui sous des sables du désert. Ce site, datant de plus de 3000 ans, révèle des fresques et des statues en parfait état de conservation.', 'image_path' => 'media/climat-ocean.jpg'],
    ['id' => 6, 'title' => 'La pénurie mondiale de semi-conducteurs ralentit l\'industrie automobile', 'author' => 'Alexandre Morel', 'date_published' => '2023-03-10', 'content' => 'Les constructeurs automobiles sont confrontés à des retards importants dans la production de véhicules, en raison de la pénurie mondiale de semi-conducteurs. Cette crise affecte également l\'électronique grand public, les smartphones, et d\'autres in...', 'image_path' => 'media/semi-conducteurs.jpg'],
    ['id' => 7, 'title' => 'Vaccination : une nouvelle campagne pour sensibiliser les jeunes', 'author' => 'Sophie Durant', 'date_published' => '2023-04-05', 'content' => 'Afin de lutter contre la désinformation sur les vaccins, le ministère de la Santé lance une campagne de sensibilisation à destination des jeunes. Cette initiative vise à informer sur les bienfaits de la vaccination et à dissiper les craintes.', 'image_path' => 'media/vaccination.jpg'],
    ['id' => 8, 'title' => 'L\'économie française se redresse progressivement après la pandémie', 'author' => 'Jean-Luc Petit', 'date_published' => '2023-05-15', 'content' => 'L\'INSEE rapporte une reprise de l\'économie française, bien que plusieurs secteurs restent fragiles après la crise liée à la COVID-19. Les services, en particulier le tourisme, retrouvent une partie de leur activité, mais l\'incertitude persiste.', 'image_path' => 'media/economie-france.jpg'],
    ['id' => 9, 'title' => 'Lutte contre le réchauffement climatique : de nouvelles mesures adoptées par l\'Union européenne', 'author' => 'Isabelle Martin', 'date_published' => '2023-06-30', 'content' => 'L\'Union européenne adopte de nouvelles réglementations pour limiter les émissions de carbone et encourager les énergies renouvelables. Ces mesures devraient aider à atteindre les objectifs de l\'Accord de Paris.', 'image_path' => 'media/climat-ue.jpg'],
    ['id' => 10, 'title' => 'Intelligence artificielle : une technologie qui transforme le secteur de la santé', 'author' => 'David Leroy', 'date_published' => '2023-08-10', 'content' => 'L\'IA joue un rôle croissant dans le domaine médical, notamment pour le diagnostic et le suivi des patients. Cependant, des questions éthiques se posent quant à son utilisation et ses impacts sur la vie privée.', 'image_path' => 'media/intelligence-artificielle.jpg']
];

// Get and validate the article ID from the URL
$articleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$articleId || !isset($articles[$articleId])) {
    // If article not found, handle gracefully
    header("HTTP/1.0 404 Not Found");
    echo "Sorry, the article you are looking for does not exist.";
    exit;
}

// Get the article
$article = $articles[$articleId];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
   <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/main_resp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>France24 - Articles</title>
</head>
<body>
    

</body>
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

    <main class="single-article">
       <div>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
            <p><strong>Auteur :</strong> <?php echo htmlspecialchars($article['author']); ?></p>
            <p><strong>Date de publication :</strong> <?php echo htmlspecialchars($article['date_published']); ?></p>
            <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
            <img src="/<?php echo htmlspecialchars($article['image_path']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
       </div>
    </main>
    <footer>
        <p>© 2024 France24. Tous droits réservés.</p>
    </footer>
</body>
</html>
