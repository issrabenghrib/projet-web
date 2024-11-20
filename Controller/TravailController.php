<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Travail.php');

class TravailController
{
    public function listTravail()
    {
        $sql = "SELECT * FROM travail";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteTravail($id)
    {
        $sql = "DELETE FROM travail WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addTravail($t)
    {   var_dump($t);
        $sql = "INSERT INTO travail
        VALUES (NULL, :typetravail,:duree, :unite)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'typetravail' => $t->getTypeTravail(),
                'duree' => $t->getDuree(),
                'unite' => $t->getUnite()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateTravail($t, $id)
{
    var_dump($t);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE travail SET 
                typetravail = :typetravail,
                duree = :duree,
                unite = :unite
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'typetravail' => $t->getTypeTravail(),
            'duree' => $t->getDuree(),
            'unite' => $t->getUnite()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showTravail($id)
    {
        $sql = "SELECT * from travail where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $t = $query->fetch();
            return $t;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
