<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/user.css">
    <title>France24 - Authentification Utilisateur</title>
</head>
<body>
    <header>
        <img src="/media/fr24_icon.jpg" alt="icon_france24"  >
        <nav>
            <a href="/">Accueil</a>
            <a href="/app/views/apropos.php">À Propos</a>
            <a href="/app/views/user.php">Identifiez-vous</a>
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

</body>
</html>





           