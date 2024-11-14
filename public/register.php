<?php
require_once __DIR__ . '../../app/controllers/registerController.php';

// Récupère les données du formulaire
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$address = $_POST['address'] ?? '';
$postal_code = $_POST['postal_code'] ?? '';
$city = $_POST['city'] ?? '';
$country = $_POST['country'] ?? '';
$phone = $_POST['phone'] ?? '';


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


header("Location: /app/views/user.php?signup_success=1");



exit;
?>