<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Activite.php');

class ActiviteController
{
    public function listActivite()
    {
        $sql = "SELECT * FROM activite";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteActivite($id)
    {
        $sql = "DELETE FROM activite WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addActivite($a)
    {   var_dump($a);
        $sql = "INSERT INTO activite
        VALUES (NULL, :methode,:quantite, :realisation)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'methode' => $a->getMethode(),
                'quantite' => $a->getQuantite(),
                'realisation' => $a->getRealisation()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateActivite($a, $id)
{
    var_dump($a);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE activite SET 
                methode = :methode,
                quantite = :quantite,
                realisation = :realisation
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'methode' => $a->getMethode(),
            'quantite' => $a->getQuantite(),
            'realisation' => $a->getRealisation()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showActivite($id)
    {
        $sql = "SELECT * from activite where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $a = $query->fetch();
            return $a;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
