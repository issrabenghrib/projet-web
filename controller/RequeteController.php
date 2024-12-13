<?php
include(__DIR__ . '/../confi.php');
include(__DIR__ . '/../Model/requete.php');


class RequeteController {
    private $db;

    public function __construct() {
        $this->db = config::getConnexion();
    }

    public function listRequetes() {
        $sql = "SELECT id_requete, date, type_de_requete FROM requete";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addRequete($requete) {
        $sql = "INSERT INTO requete (id_requete,date, type_de_requete) VALUES (:id_requete,:date, :type_de_requete)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_requete' => $requete->getId_requete(), // Inclure id_requete
                'date' => $requete->getDate(),
                'type_de_requete' => $requete->getTypeDeRequete()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateRequete($requete, $id_requete) {
        $query = "UPDATE requete SET 
                  date = :date, 
                  type_de_requete = :type_de_requete, 
                  statut = :statut 
                  WHERE id_requete = :id_requete"; // Suppression de la virgule supplémentaire
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                'date' => $requete->getDate(), // Utilisez les accesseurs pour les objets
                'type_de_requete' => $requete->getTypeDeRequete(),
                'statut' => $requete->getStatut(),
                'id_requete' => $id_requete,
            ]);
            
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function deleteRequete($id_requete) {
        $sql = "DELETE FROM requete WHERE id_requete = :id_requete";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_requete', $id_requete);
            $query->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getRequeteById($id_requete) {
        $sql = "SELECT * FROM requete WHERE id_requete = :id_requete";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_requete', $id_requete, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif avec les données de la requête
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Méthode dans RequeteController pour récupérer le nombre total de requêtes
    public function getRequeteCount() {
        $sql = "SELECT COUNT(*) AS total FROM requete";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
