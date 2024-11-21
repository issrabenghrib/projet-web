<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Date.php');

class DateController
{
    public function listDate()
    {
        $sql = "SELECT * FROM date";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteDate($id)
    {
        $sql = "DELETE FROM date WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addDate($d)
    {   var_dump($d);
        $sql = "INSERT INTO date  
        VALUES (NULL, :jour,:mois, :annee)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'jour' => $d->getJour(),
                'mois' => $d->getMois(),
                'annee' => $d->getAnnee()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateDate($d, $id)
{
    var_dump($d);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE date SET 
                jour = :jour,
                mois = :mois,
                annee = :annee
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'jour' => $d->getJour(),
            'mois' => $d->getMois(),
            'annee' => $d->getAnnee()
            
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showDate($id)
    {
        $sql = "SELECT * from date where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $d = $query->fetch();
            return $d;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
