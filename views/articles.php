<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/article.css">
</head>
<body>
<div class="articles_body">
    <div class="contenu">
            <div class="row">
                <div class="ñeft">
                    <h2>Dates and Titles of Articles</h2>
                    <ul>
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
                <div class="right">
                    <h2>Latest Press Releases</h2>

                    <?php foreach ($latestArticles as $article) { ?>
                       <?php
                            $fullContent = htmlspecialchars($article['content']);
                            $words = explode(' ', strip_tags($article['content']));
                            $shortContent = htmlspecialchars(implode(' ', array_slice($words, 0, 20))) . '...';
                       ?>  
                        <article>
                            <div>
                                <small>Reading time: <?php echo htmlspecialchars($article['duree']); ?> min</small>
                                <br><small>Published on <?php echo htmlspecialchars($article['published']); ?></small></br>
                            </div>
                            <?php if (!empty($article['image'])) { ?>
                                <img src="../database/press_media/media/<?php echo htmlspecialchars($article['image']); ?>" alt="small image" class="mr-2 image-size">
                            <?php } ?>
                            <a href="../app/controllers/single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                                <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                            </a>
                            <div class="article-content" style="margin-bottom: 1rem;">
                                <p>
                                    <span class="short-content"><?php echo $shortContent; ?></span>
                                    <span class="full-content" style="display: none;"><?php echo $fullContent; ?></span>
                                </p>
                                <button class="toggle-btn" onclick="toggleContent(this)" style="cursor:pointer; padding: 5px 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">
                                    Show more
                                </button>
                            </div>
                            <small>Source: <?php echo htmlspecialchars($article['source']); ?></small>
                            <button
                                    class="btn btn-sm btn-outline-primary add-to-favorites"
                                    data-article-id="<?php echo htmlspecialchars($article['id'] ?? $article['link']); ?>">
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


    

</body>
</html>