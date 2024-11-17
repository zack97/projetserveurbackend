<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/user.css">
    <link rel="stylesheet" href="/assets/css/main_resp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>France24 - Authentification Utilisateur</title>
</head>
<body>
<header>
        <img src="/media/fr24_icon.jpg" alt="icon_france24"  >
        <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
           <span class="name_display">Welcome, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></span> 
           <hr class="hrhr">
           <h6><?php echo htmlspecialchars($_SESSION['user']['country']);?></h6>
        <?php endif; ?>
        <div class="hamburger none_icon"><i class="fa-solid fa-bars"></i></div>
        <nav>
            <a href="/">Accueil</a>
            <a href="/app/views/apropos.php">À Propos</a>
            <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && isset($_SESSION['user']['first_name'])): ?>
                <span class="name-drop">Bonjour, <?php echo htmlspecialchars($_SESSION['user']['first_name']); ?></span>
                <a href="/public/favoris.php" class="logout-button" >Mes Favoris</a>
                <a href="/logout.php" class="logout-button">Se déconnecter</a>
            <?php else: ?>
                <a href="/app/views/user.php">Identifiez-vous</a>
            <?php endif; ?>
        </nav>

    </header>

    <main class="container">
        <div class="signup">
            <h2>Créer un compte</h2>
            <form method="POST" action="/public/register.php" class="form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="first_name">Prénom</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Nom</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date de naissance</label>
                    <input type="date" id="birthdate" name="birthdate" required>
                </div>
            
                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" name="address">
                </div>
                <div class="form-group">
                    <label for="postal_code">Code postal</label>
                    <input type="text" id="postal_code" name="postal_code">
                </div>
                <div class="form-group">
                    <label for="city">Ville</label>
                    <input type="text" id="city" name="city">
                </div>
                <div class="form-group">
                    <label for="country">Pays</label>
                    <select id="country" name="country">
                        <option>Belgique</option>
                        <option>France</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="phone">Téléphone</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <button type="submit" class="favorite-button">S'inscrire</button>
                </div>
            </form>
        </div>
      

        <hr class="divider">
        
        <div class="login">
          <h2>Connexion</h2>
            <form method="POST" action="/public/login.php" class="form">
                <div class="form-group">
                    <label for="login_email">Email</label>
                    <input type="email" id="login_email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="login_password">Mot de passe</label>
                    <input type="password" id="login_password" name="password" required>
                </div>
                <div class="form-group ">
                    <button type="submit" class="favorite-button">Se connecter</button>
                </div>
            </form>
        </div>
        
    </main>

    <footer>
        <p>© 2024 France24. Tous droits réservés.</p>
    </footer>


    <script>
         document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.querySelector('header div'); 
            const nav = document.querySelector('nav'); 

            hamburger.addEventListener('click', () => {
                nav.classList.toggle('show-nav'); 
            });
        });
    </script>
    
</body>
</html>





           