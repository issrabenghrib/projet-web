<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\index.php';  // Ensure your config file is included for DB connection
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\model\requete.php';  // The Requete model that holds your data structure

class RequeteController {

    // Add a new requete
    public function addRequete($requete) {
        $sql = "INSERT INTO requete (date, type_de_requete) VALUES (:date, :type_de_requete)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'date' => $requete->getDate(),
                'type_de_requete' => $requete->getTypeDeRequete(),
            ]);
            echo "Requete added successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Get all requetes (list them)
    public function listRequete() {
        $sql = "SELECT * FROM requete";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Get a requete by ID
    public function getRequeteById($id_requete) {
        $sql = "SELECT * FROM requete WHERE id_requete = :id_requete";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_requete' => $id_requete]);
            return $query->fetch(PDO::FETCH_ASSOC); // Return single record
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Update a requete
    public function updateRequete($requete, $id_requete) {
        $sql = "UPDATE requete SET date = :date, type_de_requete = :type_de_requete WHERE id_requete = :id_requete";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute([
                'id_requete' => $id_requete,
                'date' => $requete->getDate(),
                'type_de_requete' => $requete->getTypeDeRequete(),
            ]);
            echo $query->rowCount() . " record(s) updated successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Delete a requete
    public function deleteRequete($id_requete) {
        $sql = "DELETE FROM requete WHERE id_requete = :id_requete";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute(['id_requete' => $id_requete]);
            echo "Requete deleted successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Get total number of requetes (optional for pagination, etc.)
    public function countRequete() {
        $sql = "SELECT COUNT(*) FROM requete";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            return $query->fetchColumn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }
}
?>
