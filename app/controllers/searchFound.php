<?php

 function rechercheformulaire() {
    require_once __DIR__ . '/../../config/database.php';


    ?>
    <div class="rechecheContent" style="background-color: #fff;">
        <h1 class="text-center">Search Articles</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group ">
                    <label for="readingTimeMin">Minimum Reading Time (en minutes)</label>
                    <input 
                        type="range" 
                        class="form-control-range" 
                        id="readingTimeMin" 
                        name="readingTimeMin" 
                        min="1" 
                        max="60" 
                        value="10" 
                        oninput="document.getElementById('minTimeValue').textContent = this.value">
                    <small>Valeur : <span id="minTimeValue">10</span> minutes</small>
                </div>
                <div class="form-group">
                    <label for="readingTimeMax">Maximum Reading Time(en minutes)</label>
                    <input 
                        type="range" 
                        class="form-control-range" 
                        id="readingTimeMax" 
                        name="readingTimeMax" 
                        min="1" 
                        max="60" 
                        value="60" 
                        oninput="document.getElementById('maxTimeValue').textContent = this.value">
                    <small>Valeur : <span id="maxTimeValue">60</span> minutes</small>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <?php

    // Traiter le formulaire si soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pdo = Database::connect();

        $filteredArticles = rechercheArticles($pdo); // Get filtered articles from the database
      
        if (empty($filteredArticles)) {
            // Display message if no articles are found
            echo "<div class='alert alert-warning text-center'>No articles found for the specified reading time</div>";
        } else {
            // Display the found articles
            foundarticle($filteredArticles);
        }
    }
}






function rechercheArticles($pdo) {

    // Récupérer les données du formulaire
    $readingTimeMin = isset($_POST['readingTimeMin']) ? (int) $_POST['readingTimeMin'] : 0;
    $readingTimeMax = isset($_POST['readingTimeMax']) ? (int) $_POST['readingTimeMax'] : PHP_INT_MAX;

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM t_article WHERE readtime_art BETWEEN :readingTimeMin AND :readingTimeMax";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':readingTimeMin', $readingTimeMin, PDO::PARAM_INT);
    $stmt->bindParam(':readingTimeMax', $readingTimeMax, PDO::PARAM_INT);
    $stmt->execute();

    $filteredArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $filteredArticles; 
}







function foundarticle($articles) {
    ?>
    <div class="found_content">
        <div class="row">
            <div>
                <h1 class="text-center text-md-left">Articles Found </h1>
            </div>
        </div>

        <div class="contenu">
            <div class="row">
                <div class="">
                    <?php foreach ($articles as $article) { 
                        $fullContent = htmlspecialchars($article['content_art']);
                        $words = explode(' ', strip_tags($article['content_art']));
                        $shortContent = htmlspecialchars(implode(' ', array_slice($words, 0, 20))) . '...';
                        ?>  
                        <article class="mb-3 border-bottom pb-3">
                            <div>
                                <small>Publié le <?php echo htmlspecialchars($article['date_art'] ?? 'Date inconnue'); ?></small>
                            </div>
                            <?php if (!empty($article['image_art'])) { ?>
                                <img src="../../database/press_media/media/<?php echo htmlspecialchars($article['image_art']); ?>" 
                                     alt="Image de l'article" class="mr-2 image-size">
                            <?php } ?>
                            <a href="single_article.php?id=<?php echo htmlspecialchars($article['id_art']); ?>">
                                <h3 class="h6"><?php echo htmlspecialchars($article['title_art']); ?></h3>
                            </a>
                            <div class="article-content" style="margin-bottom: 1rem;">
                                <p>
                                    <span class="short-content"><?php echo $shortContent; ?></span>
                                    <span class="full-content" style="display: none;"><?php echo $fullContent; ?></span>
                                </p>
                                <button class="toggle-btn btn btn-sm btn-primary" onclick="toggleContent(this)">
                                    Show more
                                </button>
                            </div>
                            <div>Temps de lecture : 
                                <strong><?php echo htmlspecialchars($article['readtime_art']); ?> minutes</strong>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleContent(button) {
            const container = button.closest('.article-content');
            const shortContent = container.querySelector('.short-content');
            const fullContent = container.querySelector('.full-content');

            const isShortVisible = shortContent.style.display !== 'none';

            shortContent.style.display = isShortVisible ? 'none' : 'inline';
            fullContent.style.display = isShortVisible ? 'inline' : 'none';
            button.textContent = isShortVisible ? 'Show less' : 'Show more';
        }

    </script>
    <?php
}
?>