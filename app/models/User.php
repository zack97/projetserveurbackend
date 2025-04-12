<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $db;

    public function __construct() {
        try {
            // Establish database connection
            $this->db = new PDO('mysql:host=localhost;dbname=press_2024_v03', 'root', 'zack10', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getDb() {
        return $this->db;
    }

    // Register a new user and handle profile image upload
    public function register($data, $file) {
        try {
            // Hash the password
            $password = password_hash($data['password'], PASSWORD_BCRYPT);

            // Check if email already exists
            if ($this->isEmailTaken($data['email'])) {
                return "Email is already taken.";
            }

            // Handle profile image upload
            $profileImage = null;
            if ($file && $file['error'] == 0) {
                $targetDir = "uploads/profile_images/";
                $targetFile = $targetDir . basename($file['name']);
                move_uploaded_file($file['tmp_name'], $targetFile);
                $profileImage = $targetFile;
            }

            // Set admin status (default to 0 if not specified)
            $is_admin = isset($data['is_admin']) ? (int)$data['is_admin'] : 0;

            // Insert user into the database
            $stmt = $this->db->prepare(
                "INSERT INTO users (username, email, password, is_admin, profile_image) 
                 VALUES (:username, :email, :password, :is_admin, :profile_image)"
            );

            $stmt->execute([
                ':username' => $data['username'],
                ':email' => $data['email'],
                ':password' => $password,
                ':is_admin' => $is_admin,
                ':profile_image' => $profileImage // Save profile image path if uploaded
            ]);

            return $this->db->lastInsertId(); // Return the ID of the newly registered user
        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            return false; // Return false if registration fails
        }
    }

    // User login method
    public function login($data) {
        try {
            // Check if the email exists in the database
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $data['email']]);
            $user = $stmt->fetch();

            // Verify password and set session
            if ($user && password_verify($data['password'], $user['password'])) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'is_admin' => $user['is_admin'],
                    'profile_image' => $user['profile_image'] // Store profile image in session
                ];
                return true; // Login successful
            }
            return "Invalid email or password."; // Invalid login details
        } catch (PDOException $e) {
            error_log("Login failed: " . $e->getMessage());
            return false; // Return false on failure
        }
    }

    // Check if email is already taken
    public function isEmailTaken($email) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0; // Return true if email exists
        } catch (PDOException $e) {
            error_log("Email check failed: " . $e->getMessage());
            return false; // Return false if check fails
        }
    }

    // Get a user by their ID, including profile image
    public function getUserById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(); // Fetch and return user details
        } catch (PDOException $e) {
            error_log("Get user by ID failed: " . $e->getMessage());
            return false; // Return false if retrieval fails
        }
    }

    // Update the user's profile image
    public function updateProfileImage($userId, $file) {
        try {
            // Handle profile image upload
            if ($file && $file['error'] == 0) {
                $targetDir = "uploads/profile_images/";
                
                // Check if the directory exists, if not, create it
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);  // Creates the directory with appropriate permissions
                }
    
                $targetFile = $targetDir . basename($file['name']);
                if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                    // Update the profile image in the database
                    $stmt = $this->db->prepare("UPDATE users SET profile_image = :profile_image WHERE id = :id");
                    $stmt->execute([
                        ':profile_image' => $targetFile, // Store the new image path
                        ':id' => $userId
                    ]);
    
                    // Update the session immediately so the new image is reflected without logout
                    if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $userId) {
                        $_SESSION['user']['profile_image'] = $targetFile;
                    }
    
                    return true; // Return true if update is successful
                } else {
                    throw new Exception("Failed to move uploaded file.");
                }
            }
            return false; // Return false if no valid file uploaded
        } catch (PDOException $e) {
            error_log("Update profile image failed: " . $e->getMessage());
            return false; // Return false if update fails
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }
    
    


    // Get all users with basic details
    public function getAllUsers() {
        try {
            $stmt = $this->db->query("SELECT id, username, email, is_admin FROM users ORDER BY id DESC");
            return $stmt->fetchAll(); // Fetch and return all users
        } catch (PDOException $e) {
            error_log("Fetching all users failed: " . $e->getMessage());
            return []; // Return an empty array if fetching fails
        }
    }

    // Promote a user to admin
    public function promoteToAdmin($userId) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET is_admin = 1 WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            return true; // Return true if promotion succeeds
        } catch (PDOException $e) {
            error_log("Promote to admin failed: " . $e->getMessage());
            return false; // Return false if promotion fails
        }
    }

    // Demote an admin to a regular user
    public function demoteAdmin($userId) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET is_admin = 0 WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            return true; // Return true if demotion succeeds
        } catch (PDOException $e) {
            error_log("Demote admin failed: " . $e->getMessage());
            return false; // Return false if demotion fails
        }
    }

    // Delete a user from the database
    public function deleteUser($userId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute([':id' => $userId]);
            return true; // Return true if deletion succeeds
        } catch (PDOException $e) {
            error_log("Delete user failed: " . $e->getMessage());
            return false; // Return false if deletion fails
        }
    }
}
