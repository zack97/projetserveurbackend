<div id="alertPlaceholder"></div>

<div class="articles_body">
    <div class="contenu">
        <div class="row">
            <div class="left">
                <h2>Dates and Titles of Articles</h2>
                <ul>
                    <?php 
                    // Merge the arrays and limit to 6 articles
                    $mergedArticles = array_merge($latestArticles, $featuredArticles);
                    $limitedArticles = array_slice($mergedArticles, 1, 10); // Get only the first 6 articles
                    
                    foreach ($limitedArticles as $article) { ?>
                        <li>
                            <strong><?php echo htmlspecialchars($article['published']); ?></strong> -
                            <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                                <?php echo htmlspecialchars($article['title']); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>

            <div class="right">
                <h2>Latest Press Releases</h2>

                <?php 
                // Limit to 6 articles from latestArticles array
                $limitedLatestArticles = array_slice($latestArticles, 1, 10);
                foreach ($limitedLatestArticles as $article) { 
                    $fullContent = htmlspecialchars($article['content']);
                    $words = explode(' ', strip_tags($article['content']));
                    $shortContent = htmlspecialchars(implode(' ', array_slice($words, 0, 20))) . '...';
                ?>  
                    <article>
                        <div>
                            <small>Reading time: <?php echo htmlspecialchars($article['duree']); ?> min</small><br>
                            <small>Published on <?php echo htmlspecialchars($article['published']); ?></small>
                        </div>
                        <?php if (!empty($article['image'])) { ?>
                            <img src="../database/press_media/media/<?php echo htmlspecialchars($article['image']); ?>" alt="small image" class="art_image">
                        <?php } ?>
                        <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                            <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
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
                        <small>Source: <?php echo htmlspecialchars($article['source']); ?></small><br>
                        <button
                            class="btn btn-sm btn-outline-primary add-to-favorites mt-2"
                            data-article-id="<?php echo htmlspecialchars($article['id']); ?>">
                            Add to favorites
                        </button>
                    </article>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<!-- ✅ JS scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alertPlaceholder = document.getElementById('alertPlaceholder');

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            `;
            alertPlaceholder.appendChild(alertDiv);

            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }

        document.querySelectorAll('.add-to-favorites').forEach(button => {
            button.addEventListener('click', function () {
                const articleId = this.dataset.articleId;

                fetch('../app/controllers/favorites.php', {
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

