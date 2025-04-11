<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $db;

    public function __construct() {
        try {
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

    
    public function register($data) {
        try {
            $password = password_hash($data['password'], PASSWORD_BCRYPT);

            if ($this->isEmailTaken($data['email'])) {
                return "Email is already taken.";
            }

            $stmt = $this->db->prepare(
                "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)"
            );

            $stmt->execute([
                ':username' => $data['username'],
                ':email' => $data['email'],
                ':password' => $password,
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Registration failed: " . $e->getMessage());
            return false;
        }
    }

  
    public function login($data) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $data['email']]);
            $user = $stmt->fetch();

            if ($user && password_verify($data['password'], $user['password'])) {
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
