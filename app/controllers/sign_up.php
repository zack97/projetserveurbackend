<?php
session_start();

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

include_once './signupPage.php';