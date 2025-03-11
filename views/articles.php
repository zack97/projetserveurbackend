<div class="container mt-3">
        <div id="alertPlaceholder" class="position-fixed top-0 end-0 m-3" style="z-index: 1050;"></div>
        <div class="contenu">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="h5">Dates and Titles of Articles</h2>
                    <ul class="list-unstyled">
                        <?php foreach (array_merge($latestArticles, $featuredArticles) as $article) { ?>
                            <li>
                                <strong><?php echo htmlspecialchars($article['published']); ?></strong> -
                                <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                                    <?php echo htmlspecialchars($article['title']); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2 class="h5">Latest Press Releases</h2>

                    <?php foreach ($latestArticles as $article) { ?>
                        <article class="mb-3">
                            <div>
                                <small>Reading time: <?php echo htmlspecialchars($article['duree']); ?> min</small>
                                <br><small>Published on <?php echo htmlspecialchars($article['published']); ?></small></br>
                            </div>
                            <?php if (!empty($article['image'])) { ?>
                                <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="small image" class="mr-2 image-size">
                            <?php } ?>
                            <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                                <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                            </a>
                            <p><?php echo htmlspecialchars($article['content']); ?></p>
                            <small>Source: <?php echo htmlspecialchars($article['source']); ?></small>
                            <button 
                                class="btn btn-sm btn-outline-primary add-to-favorites" 
                                data-article-id="<?php echo htmlspecialchars($article['id']); ?>">
                                Add to favorites
                            </button>
                        </article>
                    <?php } ?>
                </div>
             
            </div>
            
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertPlaceholder = document.getElementById('alertPlaceholder');

            function showAlert(message, type) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
                alertDiv.role = 'alert';
                alertDiv.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                alertPlaceholder.appendChild(alertDiv);

                setTimeout(() => {
                    alertDiv.remove();
                }, 2000);
            }
            document.querySelectorAll('.add-to-favorites').forEach(button => {
                button.addEventListener('click', function () {
                    const articleId = this.dataset.articleId;
                    
                    fetch('./app/controllers/favorites.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            'article_id': articleId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showAlert(data.message, 'success');
                        } else {
                            showAlert(data.message, 'danger');
                        }
                    })
                    .catch(error => {
                        showAlert('Erreur lors de la requête.', 'danger');
                        console.error(error);
                    });
                });
            });
        });
    </script>


    
<!-- <div class="container mt-3">
    <div id="alertPlaceholder" class="position-fixed top-0 end-0 m-3" style="z-index: 1050;"></div>
    <div class="contenu">
        <div class="row">
            <div class="col-md-3">
                <h2 class="h5">Dates and Titles of Articles</h2>
                <ul class="list-unstyled">
                    <?php foreach (array_merge($latestArticles, $featuredArticles) as $article) { ?>
                        <li>
                            <strong><?php echo htmlspecialchars($article['published']); ?></strong> -
                            <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-6">
                <h2 class="h5">Latest Press Releases</h2>
                <?php foreach ($latestArticles as $article) { ?>
                    <article class="mb-3">
                        <div>
                            <small>Reading time: <?php echo htmlspecialchars($article['duree']); ?> min</small>
                            <br><small>Published on <?php echo htmlspecialchars($article['published']); ?></small></br>
                        </div>
                        <?php if (!empty($article['image'])) { ?>
                            <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="small image" class="mr-2 image-size">
                        <?php } ?>
                        <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                            <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                        </a>
                        <p><?php echo htmlspecialchars($article['content']); ?></p>
                        <button class="btn btn-sm btn-outline-primary add-to-favorites" data-article-id="<?php echo htmlspecialchars($article['id']); ?>">Add to favorites</button>
                    </article>
                <?php } ?>
            </div>
            <div class="col-md-3">
                <h2 class="h5">Featured Releases</h2>
                <?php foreach ($featuredArticles as $article) { ?>
                    <article class="mb-3">
                        <div>
                            <small>Reading time: <?php echo htmlspecialchars($article['duree']); ?> min</small>
                            <br><small>Published on <?php echo htmlspecialchars($article['published']); ?></small></br>
                        </div>
                        <?php if (!empty($article['image'])) { ?>
                            <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="small image" class="mr-2 image-size">
                        <?php } ?>
                        <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                            <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                        </a>
                        <p><?php echo htmlspecialchars($article['content']); ?></p>
                        <button class="btn btn-sm btn-outline-primary add-to-favorites" data-article-id="<?php echo htmlspecialchars($article['id']); ?>">Add to favorites</button>
                    </article>
                <?php } ?>
            </div>
        </div>
    </div>
</div> -->
