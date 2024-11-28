<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Ouvrier.php');

class OuvrierController
{
    public function listOuvrier()
    {
        $sql = "SELECT * FROM ouvrier";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteOuvrier($id)
    {
        $sql = "DELETE FROM ouvrier WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addOuvrier($o)
    {   var_dump($o);
        $sql = "INSERT INTO ouvrier
        VALUES (NULL,:id_travail, :nom,:prenom, :age)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'id_travail'=> $o->getIdTravail(),
                'nom' => $o->getNom(),
                'prenom' => $o->getPrenom(),
                'age' => $o->getAge()
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateOuvrier($o, $id)
{
    var_dump($o);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE ouvrier SET 
                id_travail =:id_travail,
                nom = :nom,
                prenom = :prenom,
                age = :age
                
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'id_travail' => $o->getIdTravail(),
            'nom' => $o->getNom(),
            'prenom' => $o->getPrenom(),
            'age' => $o->getAge()
            
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showOuvrier($id)
    {
        $sql = "SELECT * from ouvrier where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $o = $query->fetch();
            return $o;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function TravailOuvrier()
    {
        $sql = "SELECT o.*,t.typetravail as typetravail FROM ouvrier o join travail t on o.id_travail=t.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
