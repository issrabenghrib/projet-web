<?php

class Date{
    private ?int $id;
    private ?int $jour;
    private ?int $mois;
    private ?int $annee;
    
    // Constructor
    public function __construct(?int $id, ?int $jour, ?int $mois, ?int $annee) {
        $this->id = $id;
        $this->jour = $jour;
        $this->mois = $mois;
        $this->annee = $annee;
       
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getJour(): ?int {
        return $this->jour;
    }

    public function setJour(?int $jour): void {
        $this->jour = $jour;
    }

    public function getMois(): ?int {
        return $this->mois;
    }

    public function setMois(?int $mois): void {
        $this->mois = $mois;
    }

    public function getAnnee(): ?int {
        return $this->annee;
    }

    public function setAnnee(?int $annee): void {
        $this->annee = $annee;
    }

    
}

?>
