<?php
session_start();

require_once '../models/User.php'; 
require_once './body.php'; 

// Initialiser la classe User
$userModel = new User();

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $rememberMe = isset($_POST['remember']); // Option "Se souvenir de moi"

    // Tenter la connexion via la classe User
    $loginResult = $userModel->login(['email' => $email, 'password' => $password]);

    if ($loginResult === true) {
        // Si "Se souvenir de moi" est activé, créer un cookie
        if ($rememberMe) {
            $cookieValue = base64_encode($email . '|' . $password);
            setcookie('remember_me', $cookieValue, time() + 3600 * 24 * 3, '/'); // Durée : 3 jours
        }

        // Redirection après connexion réussie
        header("Location: /index.php");
        exit();
    } else {
        $errorMessage = "Invalid email or password.";
    }
}

// Afficher la page de connexion
generatehead('../../assets/css/main.css');
generateHeader('../../media/news.jpg', '');
generatenav('recherche.php');
?>

<div class="container full-height d-flex justify-content-center align-items-center">
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <div class="form-group remember">
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember"> Remember Me
                </label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </form>
        <div class="signup-link">
            <p style="color: black;">Don't have an account?</p>
            <p><a href="sign_up.php">Sign up here</a>.</p>
        </div>
    </div>
</div>

<?php
generatefooter('../media/res.jpg');
generateboottraap();
?>
