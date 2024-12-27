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

// Connexion à la base de données 
try {
    $pdo = new PDO('mysql:host=localhost;dbname=france24', 'root', 'zack10');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

// Initialise le tableau de favoris s'il n'existe pas encore
if (!isset($_SESSION['favoris'])) {
    $_SESSION['favoris'] = [];
}

// Vérifie si l'article est déjà dans les favoris
if (!in_array($articleId, $_SESSION['favoris'])) {
    // Ajoute l'article aux favoris
    $_SESSION['favoris'][] = $articleId;

    // Insertion dans la base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO favoris (user_id, article_id) VALUES (:user_id, :article_id)");
        $stmt->bindParam(':user_id', $_SESSION['user']);
        $stmt->bindParam(':article_id', $articleId);
        $stmt->execute();
        echo "Article ajouté aux favoris.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout aux favoris : " . $e->getMessage();
    }
} else {
    echo "Cet article est déjà dans vos favoris.";
}
?>
