<div class="container mt-3">
    <h2 class="h5">Dates and Titles of Articles</h2>
    <ul class="list-unstyled">
        <?php foreach (array_merge($latestArticles, $featuredArticles) as $article) { ?>
            <li>
                <strong><?php echo htmlspecialchars($article['published']); ?></strong> -
                <a href="single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                    <?php echo htmlspecialchars($article['title']); ?>
                </a>
            </li>
        <?php } ?>
    </ul>

    <div class="row">
        <div class="col-md-6">
            <h2 class="h5">Latest Press Releases</h2>
            <?php foreach ($latestArticles as $article) { ?>
                <article class="mb-3">
                    <div>
                        <small>Reading time : <?php echo htmlspecialchars($article['duree']); ?> min</small>
                        <br><small>Published on <?php echo htmlspecialchars($article['published']); ?></small></br>
                    </div>
                    <?php if (!empty($article['image'])) { ?>
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Article image" class="mr-2 image-size">
                    <?php } ?>
                    <a href="single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                        <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                    </a>
                    <p><?php echo htmlspecialchars($article['content']); ?></p>
                    <small>Source: <?php echo htmlspecialchars($article['source']); ?></small>
                </article>
            <?php } ?>
        </div>

        <div class="col-md-6">
            <h2 class="h5">Featured Releases</h2>
            <?php foreach ($featuredArticles as $article) { ?>
                <article class="mb-3">
                    <div>
                        <small>Reading time : <?php echo htmlspecialchars($article['duree']); ?> min</small>
                        <br><small>Published on <?php echo htmlspecialchars($article['published']); ?></small></br>
                    </div>
                    <?php if (!empty($article['image'])) { ?>
                        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Article image" class="mr-2 image-size">
                    <?php } ?>
                    <a href="single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                        <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                    </a>
                    <p><?php echo htmlspecialchars($article['content']); ?></p>
                </article>
            <?php } ?>
        </div>
    </div>
</div>
