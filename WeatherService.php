<?php
if (!class_exists('WeatherService')) {
    class WeatherService {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        // Méthodes pour gérer les prévisions

        // Ajouter une nouvelle prévision
        public function addPrediction($date, $temperature, $humidite, $pluie) {
            $stmt = $this->pdo->prepare("INSERT INTO prediction (date, temperature, humidite, pluie) VALUES (:date, :temperature, :humidite, :pluie)");
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':temperature', $temperature);
            $stmt->bindParam(':humidite', $humidite);
            $stmt->bindParam(':pluie', $pluie);
            return $stmt->execute();
        }

        // Mettre à jour une prévision existante
        public function updatePrediction($id, $temperature, $humidite, $pluie) {
            $stmt = $this->pdo->prepare("UPDATE prediction SET temperature = :temperature, humidite = :humidite, pluie = :pluie WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':temperature', $temperature);
            $stmt->bindParam(':humidite', $humidite);
            $stmt->bindParam(':pluie', $pluie);
            return $stmt->execute();
        }

        // Supprimer une prévision
        public function deletePrediction($id) {
            $stmt = $this->pdo->prepare("DELETE FROM prediction WHERE id = :id");
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }

        // Récupérer toutes les prévisions
        public function getAllPredictions() {
            $stmt = $this->pdo->query("SELECT * FROM prediction");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Récupérer une prévision par date
        public function getPredictionByDate($date) {
            $stmt = $this->pdo->prepare("SELECT * FROM prediction WHERE date = :date");
            $stmt->bindParam(':date', $date);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Méthodes pour gérer les alertes

        // Ajouter une nouvelle alerte
        public function addAlert($dateAlerte, $quantiteEau) {
            $sql = "INSERT INTO alerte (date_alerte, quantite_eau) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$dateAlerte, $quantiteEau]);
        }

        // Mettre à jour une alerte existante
        public function updateAlert($id, $dateAlerte, $quantiteEau) {
            $sql = "UPDATE alerte SET date_alerte = ?, quantite_eau = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$dateAlerte, $quantiteEau, $id]);
        }

        // Supprimer une alerte
        public function deleteAlert($id) {
            $sql = "DELETE FROM alerte WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        }

        // Récupérer toutes les alertes
        public function getAllAlerts() {
            $sql = "SELECT * FROM alerte ORDER BY date_alerte ASC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Récupérer une alerte par ID
        public function getAlertById($id) {
            $sql = "SELECT * FROM alerte WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}
?>