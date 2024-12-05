<?php
include 'Activite.php';
class Plan{
    private ?int $id;
    private $id_activite;
    private ?string $titre;
    private ?Datetime $datep;
    private ?string $messagep;
    
    // Constructor
    public function __construct(?int $id, $id_activite, ?string $titre, ?Datetime $datep, ?string $messagep) {
        $this->id = $id;
        $this->Activite = $id_activite;
        $this->titre = $titre;
        $this->datep = $datep;
        $this->messagep = $messagep;
       
    }

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }
    public function getIdActivite() {
        return $this->Activite;
    }
    public function getTitre(): ?string {
        return $this->titre;
    }

    public function setTitre(?int $titre): void {
        $this->titre = $titre;
    }

    public function getDatep(): ?datetime {
        return $this->datep;
    }

    public function setDatep(?datetime $datep): void {
        $this->datep = $datep;
    }

    public function getMessagep(): ?string {
        return $this->messagep;
    }

    public function setMessagep(?int $messagep): void {
        $this->messagep = $messagep;
    }

    
}

?>
