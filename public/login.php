<?php
require_once __DIR__ . '../../app/controllers/loginController.php';

// Récupère les données de connexion
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// (AJOUTER : Récupération de l'utilisateur depuis la base de données)

// Vérifie le mot de passe
if (password_verify($password, $hashed_password_from_db)) {
    // Initialise la session
    startSession();
    $_SESSION['user'] = [
        'email' => $email,
        'first_name' => $first_name,
    ];
    header("Location: ../../public/index.php");
    exit;
} else {
    // Si la connexion échoue, renvoie vers la page avec un message d'erreur
    header("Location: ../../app/views/user.php?login_error=1");
    exit;
}
?>

