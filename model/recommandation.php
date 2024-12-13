<?php

class Recommandation {
    private ?int $id_rec;
    private ?float $quantite_eau;
    private ?string $duree_arrosage;
    private ?string $type_arrosage;
   

    // Constructeur
    public function __construct(?int $id_rec, ?float $quantite_eau, ?string $duree_arrosage, ?string $type_arrosage) {
        $this->id_rec = $id_rec;
        $this->quantite_eau = $quantite_eau;
        $this->duree_arrosage = $duree_arrosage;
        $this->type_arrosage = $type_arrosage;
       
    }

    // Getters et Setters
    public function getIdRec(): ?int {
        return $this->id_rec;
    }

    public function setIdRec(?int $id_rec): void {
        $this->id_rec = $id_rec;
    }

    public function getQuantiteEau(): ?float {
        return $this->quantite_eau;
    }

    public function setQuantiteEau(?float $quantite_eau): void {
        $this->quantite_eau = $quantite_eau;
    }

    public function getDureeArrosage(): ?string {
        return $this->duree_arrosage;
    }

    public function setDureeArrosage(?string $duree_arrosage): void {
        $this->duree_arrosage = $duree_arrosage;
    }

    public function getTypeArrosage(): ?string {
        return $this->type_arrosage;
    }

    public function setTypeArrosage(?string $type_arrosage): void {
        $this->type_arrosage = $type_arrosage;
    }

   
    // Méthode dans RecommandationController pour récupérer le nombre total de recommandations
    public function getRecommandationCount() {
        $sql = "SELECT COUNT(*) AS total FROM recommandation";
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
