<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=france24', 'root', 'zack10');
    }

    public function register($data) {
        // Hash the password
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $this->db->prepare("INSERT INTO users (email, password, first_name, last_name, birthdate, address, postal_code, city, country, phone)
                                    VALUES (:email, :password, :first_name, :last_name, :birthdate, :address, :postal_code, :city, :country, :phone)");

        if ($stmt->execute([
            ':email' => $data['email'],
            ':password' => $password,
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':birthdate' => $data['birthdate'],
            ':address' => $data['address'],
            ':postal_code' => $data['postal_code'],
            ':city' => $data['city'],
            ':country' => $data['country'],
            ':phone' => $data['phone']
        ])) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function login($data) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $data['email']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($data['password'], $user['password'])) {
            return $user;
        }
        return false;
    }
}
