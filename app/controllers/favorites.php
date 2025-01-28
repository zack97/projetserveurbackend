<?php
// Start the session and check if the user is logged in
session_start();
require_once '../../app/models/User.php'; // Adjust the path based on your folder structure

if (!isset($_SESSION['user'])) {
    // If the user is not logged in, return an error response
    echo json_encode(['status' => 'error', 'message' => 'You must be logged in to add favorites.']);
    exit;
}

// Get the article ID from the POST request
if (isset($_POST['article_id'])) {
    $articleId = $_POST['article_id'];
    $userId = $_SESSION['user']['id']; // Assuming user ID is stored in the session

    // Initialize the User model
    $userModel = new User();

    // Check if the article is already in the user's favorites
    $stmt = $userModel->getDb()->prepare("SELECT COUNT(*) FROM favorites WHERE user_id = :user_id AND article_id = :article_id");
    $stmt->execute([':user_id' => $userId, ':article_id' => $articleId]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Article is already in the favorites
        echo json_encode(['status' => 'error', 'message' => 'This article is already in your favorites.']);
    } else {
        // Add the article to the favorites table
        $stmt = $userModel->getDb()->prepare("INSERT INTO favorites (user_id, article_id) VALUES (:user_id, :article_id)");
        if ($stmt->execute([':user_id' => $userId, ':article_id' => $articleId])) {
            echo json_encode(['status' => 'success', 'message' => 'Article added to favorites.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'An error occurred while adding to favorites.']);
        }
    }
} else {
    // If article_id is not provided, return an error
    echo json_encode(['status' => 'error', 'message' => 'Article ID is required.']);
}
?>
