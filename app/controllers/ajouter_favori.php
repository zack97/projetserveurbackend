<?php
session_start();

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Veuillez vous connecter pour ajouter des articles aux favoris.";
    exit;
}

// Vérifie si un ID d'article est envoyé
if (!isset($_POST['article_id'])) {
    echo "Aucun identifiant d'article fourni.";
    exit;
}

// Récupère l'ID de l'article
$articleId = $_POST['article_id'];

// Initialise le tableau de favoris s'il n'existe pas encore
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// Ajoute l'article aux favoris de l'utilisateur s'il n'est pas déjà dans la liste
if (!in_array($articleId, $_SESSION['favorites'])) {
    $_SESSION['favorites'][] = $articleId;
    echo "Article ajouté aux favoris.";
} else {
    echo "Cet article est déjà dans vos favoris.";
}
