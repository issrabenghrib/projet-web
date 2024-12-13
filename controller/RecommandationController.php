<?php

// Inclure le fichier confi.php en utilisant un chemin absolu
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\confi.php';
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\model\recommandation.php';

class RecommandationController {
    private $pdo;
    
    // Connexion à la base de données
    public function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=gestionrequetes', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    // Méthode pour afficher toutes les recommandations
    public function listrecommandations(): array {
        $sql = "SELECT * FROM recommandation";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    // Méthode pour ajouter une recommandation
    public function addrecommandation(Recommandation $recommandation): void {
        $sql = "INSERT INTO recommandation (quantite_eau, duree_arrosage, type_arrosage) VALUES (:quantite_eau, :duree_arrosage, :type_arrosage )";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':quantite_eau' => $recommandation->getQuantiteEau(),
            ':duree_arrosage' => $recommandation->getDureeArrosage(),
            ':type_arrosage' => $recommandation->getTypeArrosage()
            
        ]);
    }

    // Méthode pour supprimer une recommandation
    public function deleteRecommandation(int $id_rec): void {
        $sql = "DELETE FROM recommandation WHERE id_rec = :id_rec";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_rec' => $id_rec]);
    }

    // Méthode pour modifier une recommandation
    public function updateRecommandation(Recommandation $recommandation): void {
        $sql = "UPDATE recommandation SET quantite_eau = :quantite_eau, duree_arrosage = :duree_arrosage, type_arrosage = :type_arrosage, id_requete = :id_requete WHERE id_rec = :id_rec";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':quantite_eau' => $recommandation->getQuantiteEau(),
            ':duree_arrosage' => $recommandation->getDureeArrosage(),
            ':type_arrosage' => $recommandation->getTypeArrosage(),
           
            ':id_rec' => $recommandation->getIdRec()
        ]);
    }
    public function getRecommandationById($id_rec) {
        $sql = "SELECT * FROM recommandation WHERE id_rec = :id_rec"; // Votre table et colonnes
        $db = config::getConnexion(); // Récupération de la connexion à la base
        try {
            // Préparation de la requête
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_rec', $id_rec, PDO::PARAM_INT); // Liaison des paramètres
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif avec les données de la recommandation
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage()); // Gestion des erreurs
        }
    }
    // Fonction de recherche par quantité d'eau
    public function rechercherParQuantiteEau($quantite) {
        $sql = "SELECT * FROM recommandation WHERE quantite_eau = :quantite";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':quantite' => $quantite]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}


// Vérifier si une recherche a été soumise


?>