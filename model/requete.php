<?php

class Requete {
    public $id_requete;
    public $date;
    public $type_de_requete;
    private ?string $statut;
    private $db;

    public function __construct($id_requete, $date, $type_de_requete, $statut, $db) {
        $this->id_requete = $id_requete;
        $this->date = $date;
        $this->type_de_requete = $type_de_requete;
        $this->statut = $statut;
        $this->db = $db;
    }


    // Getters and Setters
    public function getId_requete(): ?int {
        return $this->id_requete;
    }

    public function setId_requete(?int $id_requete): void {
        $this->id_requete = $id_requete;
    }

    public function getDate(): ?string {
        return $this->date;
    }

    public function setDate(?string $date): void {
        $this->date = $date;
    }

    public function getTypeDeRequete(): ?string {
        return $this->type_de_requete;
    }
    public function getStatut(): ?string {
        return $this->statut;
    }
    
    public function setStatut(?string $statut): void {
        $this->statut = $statut;
    }


    public function setTypeDeRequete(?string $type_de_requete): void {
        $this->type_de_requete = $type_de_requete;
    }
    public function getRequeteCount() {
        $sql = "SELECT COUNT(*) AS total FROM requete"; // Compte le nombre de lignes dans la table 'requete'
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total']; // Retourne le nombre total de requêtes
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
}
}
?>
