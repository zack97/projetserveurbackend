<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=projetserveur', 'root', 'zack10', [
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

    /**
     * Register a new user
     */
    public function register($data) {
        try {
            // Hash the password
            $password = password_hash($data['password'], PASSWORD_BCRYPT);

            // Check if the email already exists
            if ($this->isEmailTaken($data['email'])) {
                return "Email is already taken.";
            }

            // Prepare the SQL statement
            $stmt = $this->db->prepare(
                "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)"
            );

            // Execute the statement with provided user data
            $stmt->execute([
                ':username' => $data['username'],
                ':email' => $data['email'],
                ':password' => $password,
            ]);

            // Return the ID of the newly created user
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Log in an existing user
     */
    public function login($data) {
        try {
            // Prepare SQL query to fetch the user
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $data['email']]);
            $user = $stmt->fetch();

            // Verify the password and return the user data if successful
            if ($user && password_verify($data['password'], $user['password'])) {
                // Start a session for the user
                session_start();
                $_SESSION['user'] = $user;
                return true;
            }
            return "Invalid email or password.";
        } catch (PDOException $e) {
            error_log("Login failed: " . $e->getMessage());
            return false;
        }
    }

    

    /**
     * Check if an email is already registered
     */
    public function isEmailTaken($email) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Email check failed: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get user by ID
     */
    public function getUserById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Get user by ID failed: " . $e->getMessage());
            return false;
        }
    }

  
}
