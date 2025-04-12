<?php
session_start();
require_once '../../app/models/User.php'; 
require_once '../../config/database.php'; 

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['article_id'])) {
    $userId = $_SESSION['user']['id'];
    $articleId = $_POST['article_id'];

    try {
        $db = new PDO("mysql:host=localhost;dbname=press_2024_v03;charset=utf8", 'root', 'zack10');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if already in favorites
        $checkStmt = $db->prepare("SELECT * FROM favorites WHERE user_id = :user_id AND article_id = :article_id");
        $checkStmt->execute([
            ':user_id' => $userId,
            ':article_id' => $articleId
        ]);

        if ($checkStmt->rowCount() > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Already in favorites.']);
            exit;
        }

        // Add to favorites
        $stmt = $db->prepare("INSERT INTO favorites (user_id, article_id) VALUES (:user_id, :article_id)");
        $stmt->execute([
            ':user_id' => $userId,
            ':article_id' => $articleId
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Added to favorites!']);
    } catch (PDOException $e) {
        error_log("DB Error: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Failed to add to favorites.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
