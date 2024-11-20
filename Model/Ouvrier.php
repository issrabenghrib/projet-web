<?php

class Ouvrier {
    private ?int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?int $age;
    // Constructor
    public function __construct(?int $id, ?string $nom, ?string $prenom, ?int $age) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getAge(): ?int {
        return $this->age;
    }

    public function setAge(?int $age): void {
        $this->age = $age;
    }
}

?>
