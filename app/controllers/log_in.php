<?php
session_start();

require_once '../models/User.php'; 
require_once './body.php'; 

$userModel = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $rememberMe = isset($_POST['remember']); 

    $loginResult = $userModel->login(['email' => $email, 'password' => $password]);

    if ($loginResult === true) {
        if ($rememberMe) {
            $cookieValue = base64_encode($email . '|' . $password);
            setcookie('remember_me', $cookieValue, time() + 3600 * 24 * 3, '/'); // Durée : 3 jours
        }

        header("Location: /index.php");
        exit();
    } else {
        $errorMessage = "Invalid email or password.";
    }
}

generatehead('../../assets/css/main.css');
generateHeader('../../index.php','../../database/press_media/media/news.jpg', './admin/users_admin.php','./admin/articles_admin.php', './log_in.php', './logout.php','../../favorites_list.php');
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
            <p><a href="sign_up.php" class="ajax-link">Sign up here</a>.</p>
        </div>
    </div>
</div>

<?php
generatefooter('../../database/press_media/media/res.jpg');
generateboottraap();
?>
