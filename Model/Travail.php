<?php

class Travail{
    private ?int $id;
    private ?string $typetravail;
    private ?int $duree;
    private ?string $unite;
    
    // Constructor
    public function __construct(?int $id, ?string $typetravail, ?int $duree, ?string $unite) {
        $this->id = $id;
        $this->typetravail = $typetravail;
        $this->duree = $duree;
        $this->unite = $unite;
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getTypetravail(): ?string {
        return $this->typetravail;
    }

    public function setTypetravail(?string $typetravail): void {
        $this->typetravail = $typetravail;
    }

    public function getDuree(): ?int {
        return $this->duree;
    }

    public function setDuree(?int $duree): void {
        $this->duree = $duree;
    }

    public function getUnite(): ?string {
        return $this->unite;
    }

    public function setUnite(?string $unite): void {
        $this->unite = $unite;
    }

}

?>
