<?php



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
    <!-- Font Awesome CDN -->    
    <link rel="stylesheet" href="<?php echo htmlspecialchars($cssPath)?>" />
     <link rel="stylesheet" href="../../assets/css/article.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  </head>
  <body  id="site-header">
<?php
}








 function generateHeader($indexPath='',$logoPath = '', $admin='',$client='', $loginPath = '', $logoutaction = '', $favoritesPath = '') {
     ?>
     <header class="py-4">
         <div class="container">
             <div class="row align-items-center header-ul">
                 <div class="col-md-3 text-center text-md-left">
                     <a href="<?php echo htmlspecialchars($indexPath) ?>">
                         <img src="<?php echo htmlspecialchars($logoPath); ?>" alt="icone_news" class="logo img-fluid" />
                     </a>
                 </div>
                 <div class="col-md-9 text-center text-md-right">
                     <ul class="list-unstyled d-flex flex-column flex-md-row justify-content-md-end mb-0" id="header-links">
                         <?php if (isset($_SESSION['user'])): ?>
                             <li class="mr-md-3">
                                 <a href="<?php echo htmlspecialchars($favoritesPath); ?>" class="btn btn-outline-primary">Favorites</a>
                             </li>
                             <li class="mr-md-3">
                                 <span class="text-success">
                                     <?php 
                                     echo ($_SESSION['user']['is_admin'] == 1) 
                                         ? "Admin - " . htmlspecialchars($_SESSION['user']['username']) 
                                         : "Client - " . htmlspecialchars($_SESSION['user']['username']);
                                     ?>
                                 </span>
                             </li>
                             <?php if ($_SESSION['user']['is_admin'] == 1): ?>
                                <li class="mr-md-2">
                                    <a href="<?php echo htmlspecialchars($admin) ?>" class="btn btn-outline-warning">Users</a>
                                </li>
                                <li class="mr-md-2">
                                    <a href="<?php echo htmlspecialchars($client)?>" class="btn btn-outline-info">Articles</a>
                                </li>
                            <?php endif; ?>

                             <li class="mr-md-3 d-flex align-items-center">
                                 <a href="#" data-toggle="modal" data-target="#profileImageModal" class="mr-2">
                                     <?php if (!empty($_SESSION['user']['profile_image'])): ?>
                                         <img src="<?php echo '../../app/controllers/' . htmlspecialchars($_SESSION['user']['profile_image']); ?>" 
                                              alt="Profile Image" 
                                              class="profile-img" 
                                              style="width: 25px; height:25px; border-radius: 50%;"/>
                                     <?php else: ?>
                                         <i class="fa-solid fa-user"></i>
                                     <?php endif; ?>
                                 </a>
                                 <a href="#" data-toggle="modal" data-target="#viewProfileImageModal" title="View Full Image">
                                     <i class="fas fa-eye text-primary"></i>
                                 </a>
                             </li>
                             <li class="mr-md-3">
                                 <form action="<?php echo htmlspecialchars($logoutaction) ?>" method="POST">
                                     <button type="submit" class="btn btn-danger">Log Out</button>
                                 </form>
                             </li>
                        <?php else: ?>
                             <li class="mr-md-3" style="color: #333;">Questions? +1 (202) 335-3939</li>
                             <li class="mr-md-3" style="color: #333;">Contact</li>
                             <li class="mr-md-3">
                                 <a href="<?php echo htmlspecialchars($loginPath); ?>" class="btn btn-primary">Log In</a>
                             </li>
                         <?php endif; ?>
                         <!-- Dropdown for background change -->
                         <li class="mr-md-3">
                             <div class="dropdown">
                                 <button class="btn btn-secondary dropdown-toggle" type="button" id="themeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                     Theme
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="themeDropdown">
                                     <a class="dropdown-item" href="#" id="light-theme">Light Theme</a>
                                     <a class="dropdown-item" href="#" id="dark-theme">Dark Theme</a>
                                 </div>
                             </div>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
     </header>
 
     <!-- Modal for Profile Image -->
<?php if (isset($_SESSION['user'])): ?>
    <div class="modal fade" id="profileImageModal" tabindex="-1" role="dialog" aria-labelledby="profileImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileImageModalLabel" style="color: #333;">Update Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire pour uploader une nouvelle image -->
                    <form action="../../app/controllers/upload_profile_image.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profileImage">Choose a new profile image:</label>
                            <input type="file" name="profile_image" id="profileImage" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Upload Image</button>
                    </form>

                    <!-- Formulaire pour supprimer l'image existante -->
                    <form action="../../app/controllers/delete_profile_image.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your profile image?');">
                        <button type="submit" class="btn btn-danger">Delete Profile Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewProfileImageModal" tabindex="-1" role="dialog" aria-labelledby="viewProfileImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <img src="<?php echo isset($_SESSION['user']['profile_image']) && $_SESSION['user']['profile_image'] ? '../../app/controllers/' . htmlspecialchars($_SESSION['user']['profile_image']) : 'path/to/default-profile.jpg'; ?>" 
                         alt="Full Profile Image" 
                         class="img-fluid rounded"/>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

     <script>
     // Check if the theme cookie exists on page load
     document.addEventListener('DOMContentLoaded', function() {
         const body = document.body;
         const headerLinks = document.getElementById('header-links');
         const theme = getCookie("theme") || "light"; // Default to light theme if no cookie exists
 
         // Apply theme based on the cookie value
         if (theme === "dark") {
             body.style.backgroundColor = '#343a40';
             body.style.color = '#f8f9fa';
             
             headerLinks.classList.remove('text-dark');
             headerLinks.classList.add('text-light');
         }
 
         // Event listener for changing the theme
         document.getElementById('light-theme').addEventListener('click', function() {
             // Switch to light theme
             body.style.backgroundColor = '#ffffff';
             body.style.color = '#212529';
             headerLinks.classList.remove('text-light');
             headerLinks.classList.add('text-dark');
             setCookie("theme", "light", 30); // Save theme preference in cookie for 30 days
         });
 
         document.getElementById('dark-theme').addEventListener('click', function() {
             // Switch to dark theme
             body.style.backgroundColor = '#343a40';
             body.style.color = '#f8f9fa';
             headerLinks.classList.remove('text-dark');
             headerLinks.classList.add('text-light');
             setCookie("theme", "dark", 30); // Save theme preference in cookie for 30 days
         });
     });
 
     // Helper functions for cookie handling
     function setCookie(name, value, days) {
         const expires = new Date();
         expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
         document.cookie = name + "=" + value + ";expires=" + expires.toUTCString() + ";path=/";
     }
 
     function getCookie(name) {
         const nameEQ = name + "=";
         const ca = document.cookie.split(';');
         for (let i = 0; i < ca.length; i++) {
             let c = ca[i].trim();
             if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
         }
         return null;
     }
     </script>
 <?php
 }

 



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












function generatefooter(){
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
                      <img src="../../database/press_media/media/news.jpg" alt="icone_res" class="img-fluid">
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
  








function generateboottraap(){
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
    </body>
</html>
    <?php
}






 

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