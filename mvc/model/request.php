<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\requestController.php';  // Ensure your config file is included for DB connection
class Requete {
    private ?int $id_requete;
    private ?string $date;
    private ?string $type_de_requete;

    // Constructor
    public function __construct(?int $id_requete, ?string $date, ?string $type_de_requete) {
        $this->id_requete = $id_requete;
        $this->date = $date;
        $this->type_de_requete = $type_de_requete;
    }

    // Getters and Setters
    public function getIdRequete(): ?int {
        return $this->id_requete;
    }

    public function setIdRequete(?int $id_requete): void {
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

    public function setTypeDeRequete(?string $type_de_requete): void {
        $this->type_de_requete = $type_de_requete;
    }
}

?>
