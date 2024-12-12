<?php
class MeteoModel {
    private $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'meteo';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getAllMeteo() {
        $stmt = $this->pdo->query("SELECT * FROM prediction");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMeteo($date, $temperature, $humidite, $Pluie) {
        $stmt = $this->pdo->prepare("INSERT INTO prediction (date, temperature, humidite, Pluie) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$date, $temperature, $humidite, $Pluie]);
    }

    public function updateMeteo($id, $date, $temperature, $humidite, $Pluie) {
        $stmt = $this->pdo->prepare("UPDATE prediction SET date = ?, temperature = ?, humidite = ?, Pluie = ? WHERE id = ?");
        return $stmt->execute([$date, $temperature, $humidite, $Pluie, $id]);
    }

    public function deleteMeteo($id) {
        $stmt = $this->pdo->prepare("DELETE FROM prediction WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>