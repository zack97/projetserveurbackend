<?php
session_start();
require_once '../../config/database.php';
require_once '../models/User.php';



// Check if user is logged in
if (!isset($_SESSION['user'])) {
    die("You must be logged in to update your profile image.");
}

// Handle form submission and file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $userId = $_SESSION['user']['id'];  // Get the logged-in user's ID
    $file = $_FILES['profile_image'];  // The uploaded file

    // Create an instance of the UserModel (assuming you have a model class to handle user data)
    $userModel = new User(); // Initialize your UserModel class

    // Call the updateProfileImage method to upload and update the database
    $result = $userModel->updateProfileImage($userId, $file);

    if ($result) {
        // Redirect to the profile or any page you'd like after successful upload
        header("Location: /index.php"); // Replace with the desired redirect
        exit;
    } else {
        echo "Failed to upload the profile image.";
    }
}

?>
