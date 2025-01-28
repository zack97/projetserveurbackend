<?php
/**************************
 * Ce contrôleur contient la structure de la page de création de compte, en régroupant 
 * ses fonctions tout en définissant les valeurs des paramètres.
 ***************************/

session_start();

require_once './body.php';
require_once '../models/User.php'; // Inclure la classe User

// Initialiser la classe User
$userModel = new User();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm-password']);

    // Vérification des mots de passe
    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } elseif ($userModel->isEmailTaken($email)) {
        // Vérifier si l'email existe déjà
        $errorMessage = "Email is already taken.";
    } else {
        // Enregistrer l'utilisateur
        $registrationSuccess = $userModel->register([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        if ($registrationSuccess) {
            $successMessage = "User registered successfully! You can now log in.";
        } else {
            $errorMessage = "An error occurred. Please try again.";
        }
    }
}

// Générer la structure de la page
generatehead('../../assets/css/main.css');
generateHeader('../../media/news.jpg', 'log_in.php');
generatenav('recherche.php');
?>

<div class="container full-height d-flex justify-content-center align-items-center">
    <div class="signup-container">
        <h1>Sign Up</h1>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($errorMessage); ?></div>
        <?php elseif (isset($successMessage)) : ?>
            <div class="alert alert-success"><?= htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
        <div class="login-link">
            <p style="color: black;">Already have an account?</p>
            <p><a href="log_in.php">Log in here</a>.</p>
        </div>
    </div>
</div>

<?php
generatefooter('../media/res.jpg');
generateboottraap();
?>
