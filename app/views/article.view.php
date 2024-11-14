<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo $article['title']; ?></title>
</head>
<body>
    <header>
        <h1><?php echo $article['title']; ?></h1>
    </header>
    <main>
        <p><?php echo $article['content']; ?></p>
    </main>
    <footer>
        <p>© 2024 France24. Tous droits réservés.</p>
    </footer>
</body>
</html>
