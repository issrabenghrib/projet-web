<?php
// Dashboard.php - Modèle pour le Dashboard
/*class Dashboard {
    private $db;

    // Constructeur qui prend la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Exemple de méthode pour récupérer le nombre total de requêtes
    public function getTotalRequetes() {
        $sql = "SELECT COUNT(*) AS total FROM requete";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Exemple de méthode pour récupérer les requêtes récemment mises à jour
    public function getRecentRequetes() {
        $sql = "SELECT * FROM requete ORDER BY date DESC LIMIT 5";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // D'autres méthodes pour d'autres statistiques peuvent être ajoutées ici
}
?>
