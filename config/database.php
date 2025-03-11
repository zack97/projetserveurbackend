<?php



class Database {
    private static $host = 'localhost';  // Remplace par ton hôte
   // private static $dbname = 'press_2024_v03';  // Remplace par le nom de ta base
     private static $dbname = 'press_2024_v03';  // Remplace par le nom de ta base
    private static $user = 'root';  // Remplace par ton utilisateur MySQL
    private static $password = 'zack10';  // Remplace par ton mot de passe
    private static $pdo = null;

    public static function connect() {
        if (self::$pdo === null) {
            try {
                // Utilisation de "mysql" au lieu de "pgsql" pour MySQL
                self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

?>