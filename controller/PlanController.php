<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Plan.php');

class PlanController
{
    public function listPlan()
    {
        $sql = "SELECT * FROM plan";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletePlan($id)
    {
        $sql = "DELETE FROM plan WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addPlan($p)
    {   var_dump($p);
        $sql = "INSERT INTO plan
        VALUES (NULL,:id_activite, :titre,:datep, :messagep)";
        $db = config::getConnexion();
        try {
            
            $query = $db->prepare($sql);
            $query->execute([
                'id_activite'=> $p->getIdActivite(),
                'titre' => $p->getTitre(),
                'datep' => $p->getDatep()->format('Y-m-d'),
                'messagep' => $p->getMessagep()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatePlan($p, $id)
{
    var_dump($p);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE plan SET 
            id_activite =:id_activite,
                titre = :titre,
                datep = :datep,
                messagep = :messagep
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'id_activite' => $p->getIdActivite(),
            'titre' => $p->getTitre(),
            'datep' => $p->getDatep()->format('Y-m-d'),
            'messagep' => $p->getMessagep()
            
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showPlan($id)
    {
        $sql = "SELECT * from plan where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $p = $query->fetch();
            return $p;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function ActivitePlan()
    {
        $sql = "SELECT p.*,a.methode as methode FROM plan p join activite a on p.id_activite=a.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function deleteRealisedPlans()
    {
        $db = config::getConnexion();
        try {
            $sql = "DELETE FROM activite WHERE realisation = :realisation";
            $query = $db->prepare($sql);
            $query->execute(['realisation' => 'realise']);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}
