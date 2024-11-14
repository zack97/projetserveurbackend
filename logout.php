<?php
require_once __DIR__ . '/app/utils/session.php';

// Détruit la session pour déconnecter l'utilisateur
destroySession();

// Redirige vers la page d'accueil ou la page de connexion
header("Location: /index.php");
exit;
