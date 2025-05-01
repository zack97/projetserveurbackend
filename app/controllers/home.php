<?php
require_once __DIR__ . '/../../models/ArticleModel.php';
//continue
// Initialiser les variables
$favoritesPath = isset($favoritesPath) ? $favoritesPath : '../../favorites_list.php'; // Chemin des favoris par défaut
$admin = isset($admin) ? $admin : './app/controllers/admin/users_admin.php'; // Lien vers l'admin, valeur par défaut
$client = isset($client) ? $client : './app/controllers/admin/articles_admin.php'; // Lien vers le client, valeur par défaut
$logoutaction = isset($logoutaction) ? $logoutaction : './app/controllers/logout.php'; // Lien de déconnexion, valeur par défaut

// Récupération des articles
$latestArticles = ArticleModel::getArticles(); // Appel statique à la méthode getArticles()
$featuredArticles = ArticleModel::getFeaturedArticles(); // Appel statique à la méthode getFeaturedArticles()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Newswire Jamaica</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="../../assets/css/article.css">
    <link rel="stylesheet" href="../../assets/cssResponssive/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body id="site-header">

<header class="py-4">
    <div class="container">
        <div class="row align-items-center header-ul">
            <div class="col-md-3 text-center text-md-left">
                <a href="#"  class="ajax-link">
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
                            <a href="#" data-toggle="modal" data-target="#viewProfileImageModal" title="View Full Image"   class="ajax-link">
                                <i class="fas fa-eye text-primary"></i>
                            </a>
                        </li>
                        <li class="mr-md-3">
                            <form id="logoutForm" action="<?php echo htmlspecialchars($logoutaction) ?>" method="POST">
                                <button type="submit" class="btn btn-danger">Log Out</button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li class="mr-md-3 none" style="color: #333;">Questions? +1 (202) 335-3939</li>
                        <li class="mr-md-3 none" style="color: #333;">Contact</li>
                        <li class="mr-md-3">
                            <a href="/app/controllers/loginPage.php" class="btn btn-primary ajax-link">Log In</a>
                        </li>
                    <?php endif; ?>
                    <li class="mr-md-3">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="themeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Theme
                            </button>
                            <div class="dropdown-menu" aria-labelledby="themeDropdown">
                                <a class="dropdown-item ajax-link" href="#" id="light-theme">Light Theme</a>
                                <a class="dropdown-item ajax-link" href="#" id="dark-theme">Dark Theme</a>
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
                    <form id="profileImageForm" action="../../app/controllers/upload_profile_image.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="profileImage">Choose a new profile image:</label>
                            <input type="file" name="profile_image" id="profileImage" class="form-control" required />
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Upload Image</button>
                    </form>

                    <form id="deleteProfileImageForm" action="../../app/controllers/delete_profile_image.php" method="POST" onsubmit="return confirm('Are you sure you want to delete your profile image?');">
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
     document.querySelectorAll('.ajax-form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche la soumission classique du formulaire

            const action = this.action;
            const method = this.method;
            const formData = new FormData(this); // Récupère les données du formulaire

            $.ajax({
                url: action,
                type: method,
                data: formData,
                processData: false, // Pour que jQuery ne traite pas les données
                contentType: false, // Important pour l'upload de fichiers
                success: function(response) {
                    // Mettre à jour l'interface utilisateur ou effectuer une autre action
                    if (response.redirect) {
                        window.location.href = response.redirect; // Redirige si nécessaire
                    } else {
                        location.reload(); // Recharge la page après l'action
                    }
                }
            });
        });
    });

    // Handle logout without page reload
    document.getElementById('logoutForm').addEventListener('submit', function(event) {
        event.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            location.reload(); // Reload the page after logout
        });
    });

    // Handle profile image upload without page reload
    document.getElementById('profileImageForm').addEventListener('submit', function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                location.reload(); // Reload the page after profile image upload
            }
        });
    });

    // Handle theme change
    document.getElementById('light-theme').addEventListener('click', function() {
        document.body.style.backgroundColor = '#ffffff';
        document.body.style.color = '#212529';
        document.cookie = "theme=light;path=/";
    });

    document.getElementById('dark-theme').addEventListener('click', function() {
        document.body.style.backgroundColor = '#343a40';
        document.body.style.color = '#f8f9fa';
        document.cookie = "theme=dark;path=/";
    });
</script>

<nav class="bg-dark text-white py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                    <button class="btn btn-dark" type="button">
                        About
                    </button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-dark" type="button">Pricing</button>
            </div>
            <div class="col-md-2">
                    <button class="btn btn-dark" type="button">
                        Favorites
                    </button>
            </div>
            <div class="col-md-2">
                    <button class="btn btn-dark " ype="button" >
                        Users
                    </button>
            </div>
            <div class="col-md-2">
                    <button class="btn btn-dark" type="button">
                        Articles
                    </button>
            </div>
            <div class="col-md-12 nav_search">
                <button class="btn btn-dark w-100" type="button"><a href= "/app/controllers/recherche.php">Search Articles</a></button>
            </div>
        </div>
    </div>
</nav>

<?php
$controller = new ArticleController();
$controller->showArticles();
?>

<footer class="footer">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-4">
                <ul class="list-unstyled">
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <p>&copy; 2025 Newswire Jamaica</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>



</body>
</html>
