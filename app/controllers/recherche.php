<?php 
session_start();
require_once __DIR__ . '/../../models/ArticleModel.php';
require_once './searchFound.php';  
// Initialiser les variables
$favoritesPath = isset($favoritesPath) ? $favoritesPath : '../../favorites_list.php'; // Chemin des favoris par défaut
$admin = isset($admin) ? $admin : './admin/users_admin.php'; // Lien vers l'admin, valeur par défaut
$client = isset($client) ? $client : './admin/articles_admin.php'; // Lien vers le client, valeur par défaut
$logoutaction = isset($logoutaction) ? $logoutaction : './logout.php'; // Lien de déconnexion, valeur par défaut

// Récupération des articles
$latestArticles = ArticleModel::getArticles(); // Appel statique à la méthode getArticles()
$featuredArticles = ArticleModel::getFeaturedArticles(); // Appel statique à la méthode getFeaturedArticles()


?>

<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- Font Awesome CDN -->    
    <link rel="stylesheet" href="../../assets/css/main.css" />
     <link rel="stylesheet" href="../../assets/css/article.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
   </head>
   <body  id="site-header">
   <header class="py-4">
         <div class="container">
             <div class="row align-items-center header-ul">
                 <div class="col-md-3 text-center text-md-left">
                     <a href="../../index.php" class="ajax-link">
                         <img src="../../database/press_media/media/news.jpg" alt="icone_news" class="logo img-fluid" />
                     </a>
                 </div>
                 <div class="col-md-9 text-center text-md-right">
                     <ul class="list-unstyled d-flex flex-column flex-md-row justify-content-md-end mb-0" id="header-links">
                         <?php if (isset($_SESSION['user'])): ?>
                             <li class="mr-md-3">
                                 <a href="<?php echo htmlspecialchars($favoritesPath); ?>" class="btn btn-outline-primary ajax-link">Favorites</a>
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
                                    <a href="<?php echo htmlspecialchars($admin) ?>" class="btn btn-outline-warning ajax-link">Users</a>
                                </li>
                                <li class="mr-md-2">
                                    <a href="<?php echo htmlspecialchars($client)?>" class="btn btn-outline-info ajax-link">Articles</a>
                                </li>
                            <?php endif; ?>

                             <li class="mr-md-3 d-flex align-items-center">
                                 <a href="#" data-toggle="modal" data-target="#profileImageModal" class="mr-2 ajax-link">
                                     <?php if (!empty($_SESSION['user']['profile_image'])): ?>
                                         <img src="<?php echo '../../app/controllers/' . htmlspecialchars($_SESSION['user']['profile_image']); ?>" 
                                              alt="Profile Image" 
                                              class="profile-img" 
                                              style="width: 25px; height:25px; border-radius: 50%;"/>
                                     <?php else: ?>
                                         <i class="fa-solid fa-user"></i>
                                     <?php endif; ?>
                                 </a>
                                 <a href="#" data-toggle="modal" data-target="#viewProfileImageModal" title="View Full Image" class="ajax-link">
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
                                 <a href="/app/controllers/loginPage.php" class="btn btn-primary ajax-link">Log In</a>
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
   <nav class="bg-dark text-white py-2">
        <div class="container">
            <div class="row ">
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="aboutDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            About
                        </button>
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
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="pressReleasesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Press Releases
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="newswiresDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Newswires
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle w-100" type="button" id="knowledgeBaseDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Knowledge Base
                        </button>
                    </div>
                </div>
				<div class="col-md-12 nav_search">
                    <button class="btn btn-dark w-100" type="button"><a href= "#">Search Articles</a></button>
                </div>
            </div>
        </div>
    </nav>
    
<div class="full_recherche_content">
    <?php rechercheformulaire();?>
</div>
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


    </body>
</html>
