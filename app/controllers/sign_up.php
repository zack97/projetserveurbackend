<?php
session_start();

require_once './body.php';
require_once '../models/User.php';

$userModel = new User();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm-password']);
    $isAdmin = isset($_POST['is_admin']);  // Si l'utilisateur est un admin, on récupère cette valeur

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } elseif ($userModel->isEmailTaken($email)) {
        $errorMessage = "Email is already taken.";
    } else {
        // Vérifier si le fichier est téléchargé
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $profileImage = $_FILES['profile_image'];
        } else {
            $profileImage = null;
        }

        // Passer les données et le fichier à la fonction register
        $registrationSuccess = $userModel->register([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'is_admin' => $isAdmin,  // Passer cette valeur lors de l'enregistrement
        ], $profileImage);  // Passer également le fichier

        if ($registrationSuccess) {
            $successMessage = "User registered successfully! You can now log in.";
        } else {
            $errorMessage = "An error occurred. Please try again.";
        }
    }
}



generatehead('../../assets/css/main.css');
generateHeader('../../database/press_media/media/news.jpg', 'log_in.php');
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

            <!-- Option pour définir un utilisateur comme admin -->
            <div class="form-group">
                <label for="is_admin">
                    <input type="checkbox" id="is_admin" name="is_admin"> Register as Admin
                </label>
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
