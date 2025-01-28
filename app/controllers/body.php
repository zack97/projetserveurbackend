<?php

/**************************
 * Cette fonction contient le head, meta .. du site.
 *               GENERATEHEAD()
 * *************************************************** */

function generatehead($cssPath=''){ ?>
  <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Newswire Jamaica</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="<?php echo htmlspecialchars($cssPath)?>" />
  </head>
  <body>
<?php
}





/***************************************************************************************** */






/**************************
 * Cette fonction contient le header du site.
 *               GENERATEHEADER()
 * *************************************************** */


function generateHeader($logoPath = '', $loginPath = '', $logoutaction='', $favoritesPath='') {
    ?>
    <header class="bg-light py-3">
        <div class="container">
            <div class="row align-items-center header-ul">
                <div class="col-md-3 text-center text-md-left">
                    <a href="../../index.php">
                        <img src="<?php echo htmlspecialchars($logoPath); ?>" alt="icone_news" class="logo img-fluid" />
                    </a>
                </div>
                <div class="col-md-9 text-center text-md-right">
                    <ul class="list-unstyled d-flex flex-column flex-md-row justify-content-md-end mb-0">
                        <?php if (isset($_SESSION['user'])): ?>
                            <!-- Si l'utilisateur est connecté -->
                            <li class="mr-md-3">
                                <a href="<?php echo htmlspecialchars($favoritesPath); ?>" class="btn btn-outline-primary">Favorites</a>
                            </li>
                            <li class="mr-md-3">| Welcome - <span class="text-success"><?php echo htmlspecialchars($_SESSION['user']['username']); ?></span></li>
                            <li class="mr-md-3">
                                <form action="<?php echo htmlspecialchars($logoutaction)?>" method="POST">
                                    <button type="submit" class="btn btn-danger">Log Out</button>
                                </form>
                            </li>
                        <?php else: ?>
                            <!-- Si l'utilisateur n'est pas connecté -->
                            <li class="mr-md-3">Questions? +1 (202) 335-3939</li>
                            <li class="mr-md-3">Contact</li>
                            <li class="mr-md-3">
                                <a href="<?php echo htmlspecialchars($loginPath); ?>" class="btn btn-primary">Log In</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <?php
}





/***************************************************************************************** */





/**************************
 * Cette fonction contient la nav du site.
 *               GENERATENAV()
 * *************************************************** */


function generatenav($recherchePath=''){
    ?>
   <nav class="bg-dark text-white py-2">
        <div class="container">
            <div class="row ">
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="aboutDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About
                        </button>
                        <div class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <a class="dropdown-item" href="#">About EIN Presswire</a>
                            <a class="dropdown-item" href="#">How We Are Different. Better</a>
                            <a class="dropdown-item" href="#">How It Works</a>
                            <a class="dropdown-item" href="#">Testimonials</a>
                            <a class="dropdown-item" href="#">Contact</a>
                            <a class="dropdown-item" href="#">EIN Presswire in the News</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark w-100" type="button">Pricing</button>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="distributionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Distribution
                        </button>
                        <div class="dropdown-menu" aria-labelledby="distributionDropdown">
                            <a class="dropdown-item" href="#">Distribution Overview</a>
                            <a class="dropdown-item" href="#">Media Database</a>
                            <a class="dropdown-item" href="#">Major News Sites</a>
                            <a class="dropdown-item" href="#">U.S. TV & Radio Stations</a>
                            <a class="dropdown-item" href="#">U.S. & International Newswires</a>
                            <a class="dropdown-item" href="#">Newswires by Industry</a>
                            <a class="dropdown-item" href="#">Newswires by Country</a>
                            <a class="dropdown-item" href="#">Newswires by U.S. state</a>
                            <a class="dropdown-item" href="#">Mobile Apps</a>
                            <a class="dropdown-item" href="#">NewsPlugin</a>
                            <a class="dropdown-item" href="#">NLive Feed</a>
                            <a class="dropdown-item" href="#">Sample Distribution Report</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="pressReleasesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Press Releases
                        </button>
                        <div class="dropdown-menu" aria-labelledby="pressReleasesDropdown">
                            <a class="dropdown-item" href="#">All</a>
                            <a class="dropdown-item" href="#">Featured</a>
                            <a class="dropdown-item" href="#">By Industry</a>
                            <a class="dropdown-item" href="#">By country</a>
                            <a class="dropdown-item" href="#">By U.S. state</a>
                            <a class="dropdown-item" href="#">Archive</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="newswiresDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Newswires
                        </button>
                        <div class="dropdown-menu" aria-labelledby="newswiresDropdown">
                            <a class="dropdown-item" href="#">U.S. & International Newswires</a>
                            <a class="dropdown-item" href="#">Newswires by Industry</a>
                            <a class="dropdown-item" href="#">Newswires by Country</a>
                            <a class="dropdown-item" href="#">Newswires by US State</a>
                            <a class="dropdown-item" href="#">Live Feed</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="knowledgeBaseDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Knowledge Base
                        </button>
                        <div class="dropdown-menu" aria-labelledby="knowledgeBaseDropdown">
                            <a class="dropdown-item" href="#">Editorial Guidelines</a>
                            <a class="dropdown-item" href="#">Getting Started Guide (PDF)</a>
                            <a class="dropdown-item" href="#">Video Tutorials</a>
                            <a class="dropdown-item" href="#">How to Write Great Press Release</a>
                            <a class="dropdown-item" href="#">FAQs</a>
                            <a class="dropdown-item" href="#">RSS Feeds</a>
                            <a class="dropdown-item" href="#">Email Newsletters</a>
                            <a class="dropdown-item" href="#">News Alert Maker</a>
                            <a class="dropdown-item" href="#">Affiliate Program</a>
                        </div>
                    </div>
                </div>
				<div class="col-md-12 nav_search">
                    <button class="btn btn-dark w-100" type="button"><a href= "<?php echo htmlspecialchars($recherchePath); ?>">Search Articles</a></button>
                </div>
            </div>
        </div>
    </nav>
    <?php
}










/***************************************************************************************** */




/**************************
 * Cette fonction contient le footer du site.
 *               GENERATEHEADER()
 * *************************************************** */

function generatefooter($iconImg='./View/media/res.jpg'){
    ?>
     <footer class="footer">
          <div class="container">
              <div class="row">
                  <div class="col-12 col-md-4 col-lg-2 bloc">
                      <h3>PR Distribution</h3>
                      <ul>
                          <li>How It Works</li>
                          <li>Why Us</li>
                          <li>Pricing</li>
                          <li>Distribution</li>
                          <li>Editorial Guidelines</li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-4 col-lg-2 bloc">
                      <h3>Newswires</h3>
                      <ul>
                          <li>All Newswires</li>
                          <li>World Newswires</li>
                          <li>US Newswires</li>
                          <li>Industry Newswires</li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-4 col-lg-2 bloc">
                      <h3>Press Releases</h3>
                      <ul>
                          <li>All Press Releases</li>
                          <li>Releases by Country</li>
                          <li>Releases by US State</li>
                          <li>Releases by Industry</li>
                          <li>Releases by Date</li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-4 col-lg-2 bloc">
                      <h3>Press Resources</h3>
                      <ul>
                          <li>World Media Directory</li>
                          <li>Mobile App</li>
                          <li>Affiliate Program</li>
                          <li>RSS Feeds</li>
                          <li>Email Newsletters</li>
                          <li>News Alert Maker</li>
                          <li>NewsPlugin</li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-4 col-lg-2 bloc">
                      <h3>Help/Support</h3>
                      <ul>
                          <li>FAQ</li>
                          <li>Video Tutorials</li>
                          <li>Client Testimonials</li>
                      </ul>
                  </div>
                  <div class="col-12 col-md-4 col-lg-2 bloc">
                      <h3>About</h3>
                      <ul>
                          <li>About EIN Presswire</li>
                          <li>Newsroom</li>
                          <li>Investor Inquiries</li>
                          <li>Career Opportunities</li>
                          <li>Contact</li>
                          <li>Follow EIN Presswire</li>
                      </ul>
                      <img src="<?php echo htmlspecialchars($iconImg)?>" alt="icone_res" class="img-fluid">
                  </div>
              </div>
              <div class="row sous">
                  <div class="col-12 col-md-3 text-center text-md-left">
                      <h6>User Agreement</h6>
                  </div>
                  <div class="col-12 col-md-3 text-center text-md-left">
                      <h6>Privacy Policy</h6>
                  </div>
                  <div class="col-12 col-md-3 text-center text-md-left">
                      <h6>Copyright Policy</h6>
                  </div>
                  <div class="col-12 col-md-3 text-center text-md-left">
                      <h6>©1995-2024 Newsmatics Inc. dba EIN Presswire All Rights Reserved.</h6>
                  </div>
              </div>
          </div>
      </footer>
  
    <?php
  }
  




/***************************************************************************************** */




/**************************
 * Cette fonction contient les liens bootsraap et la fermeture du body et html du site.
 *               GENERATEBOOTTRAAP()
 * *************************************************** */



function generateboottraap(){
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    </body>
</html>
    <?php
}









/**************************
 * Cette fonction contient le formulaire de recherche d'articles sur le site.
 *               RECHERCHEFORMULAIRE()
 * *************************************************** */

 

 function rechercheformulaire() {
    require_once __DIR__ . '/../../config/database.php';


    ?>
    <div class="container mt-3">
        <h1 class="text-center">Search Articles</h1>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
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
                <div class="form-group col-md-6">
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






/***************************************************************************************** */





/**************************
 * Cette fonction gère l'envoi des requêtes de recherche d'articles au serveur
 *               RECHERCHEARTICLES()
 * *************************************************** */


function rechercheArticles($pdo) {

    // Récupérer les données du formulaire
    $readingTimeMin = isset($_POST['readingTimeMin']) ? (int) $_POST['readingTimeMin'] : 0;
    $readingTimeMax = isset($_POST['readingTimeMax']) ? (int) $_POST['readingTimeMax'] : PHP_INT_MAX;

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM articles WHERE duree BETWEEN :readingTimeMin AND :readingTimeMax";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':readingTimeMin', $readingTimeMin, PDO::PARAM_INT);
    $stmt->bindParam(':readingTimeMax', $readingTimeMax, PDO::PARAM_INT);
    $stmt->execute();

    $filteredArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $filteredArticles; 
}




/***************************************************************************************** */



/**************************
 * Cette fonction contient les articles retrouver après recherche
 *               FOUNDARTICLES()
 * *************************************************** */


function foundarticle($articles) {
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center text-md-left">Résultats de la Recherche</h1>
            </div>
        </div>

        <div class="contenu">
            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($articles as $article) { ?>
                        <article class="mb-3 border-bottom pb-3">
                            <div>
                                <small>Publié le <?php echo htmlspecialchars($article['published'] ?? 'Date inconnue'); ?></small>
                            </div>
                            <?php if (!empty($article['image'])) { ?>
                                <img src="../.<?php echo htmlspecialchars($article['image']); ?>" 
                                     alt="Image de l'article" class="mr-2 image-size">
                            <?php } ?>
                            <a href="single_article.php?id=<?php echo htmlspecialchars($article['id']); ?>">
                                <h3 class="h6"><?php echo htmlspecialchars($article['title']); ?></h3>
                            </a>
                            <p><?php echo htmlspecialchars($article['content']); ?></p>
                            <small>Source : <?php echo htmlspecialchars($article['source'] ?? 'Source inconnue'); ?></small>
                            <div>Temps de lecture : 
                                <strong><?php echo htmlspecialchars($article['duree']); ?> minutes</strong>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>