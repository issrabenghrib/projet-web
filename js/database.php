/*<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');         // Utilisateur par défaut de XAMPP
define('DB_PASS', '');             // Mot de passe par défaut de XAMPP
define('DB_NAME', 'weather_db');   // Nom de votre base de données

// Création de la connexion
function getDBConnection() {
    try {
        $conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
            DB_USER,
            DB_PASS,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>




<?php
// Check if the class already exists before declaring it
if (!class_exists('config')) {
    class config
    {   
        private static $pdo = null;

        public static function getConnexion()
        {
            if (!isset(self::$pdo)) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "weather_db";

                try {
                    self::$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                    die('Erreur: ' . $e->getMessage());
                }
            }
            return self::$pdo;
        }
    }
}