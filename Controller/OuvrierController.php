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
        VALUES (NULL, :nom,:prenom, :age)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
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
                nom = :nom,
                prenom = :prenom,
                age = :age
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
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
}
