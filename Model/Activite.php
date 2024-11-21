<?php

class Activite{
    private ?int $id;
    private ?string $methode;
    private ?float $quantite;
    private ?bool $realisation;
    
    // Constructor
    public function __construct(?int $id, ?string $methode, ?float $quantite, ?bool $realisation) {
        $this->id = $id;
        $this->methode = $methode;
        $this->quantite = $quantite;
        $this->realisation = $realisation;
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getMethode(): ?string {
        return $this->methode;
    }

    public function setMethode(?string $methode): void {
        $this->methode = $methode;
    }

    public function getQuantite(): ?float {
        return $this->quantite;
    }

    public function setQuantite(?float $quantite): void {
        $this->quantite = $quantite;
    }

    public function getRealisation(): ?bool {
        return $this->realisation;
    }

    public function setRealisation(?bool $realisation): void {
        $this->realisation = $realisation;
    }

}

?>
