<?php
include '../../controller/ActiviteController.php';

// Crée une instance du contrôleur
$activiteC = new ActiviteController();

// Appelle la méthode pour supprimer tous les plans réalisés
$activiteC->deleteRealisedPlans();

// Redirige vers la liste des activités après suppression
header('Location: aList.php');
exit;
?>
