<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RecommandationController.php';

$error = "";
$recommandationController = new RecommandationController();

// Vérifier si l'ID est passé en paramètre
if (isset($_GET['id_rec']) && !empty($_GET['id_rec'])) {
    $id_rec = $_GET['id_rec'];
    $recommandation = $recommandationController->getRecommandationById($id_rec);
    if (!$recommandation) {
        $error = "Recommandation introuvable.";
    }
} else {
    $error = "Erreur : Aucun ID fourni.";
    exit;
}

// Gérer la mise à jour après soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_rec = $_POST['id_rec'];
    $quantite_eau = $_POST['quantite_eau'];
    $duree_arrosage = $_POST['duree_arrosage'];
    $type_arrosage = $_POST['type_arrosage'];
    $type_plante = $_POST['type_plante'];

    $recommandation = new Recommandation(
        $id_rec,
        $quantite_eau,
        $duree_arrosage,
        $type_arrosage,
        $type_plante
    );

    try {
        $recommandationController->updateRecommandation($recommandation);
        header('Location: listrecommandation.php');
        exit;
    } catch (Exception $e) {
        echo 'Erreur lors de la mise à jour : ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mettre à Jour Recommandation</title>
    <style>
        /* Votre style CSS */
    </style>
</head>
<body>

<header>
    <h1>Mettre à Jour une Recommandation</h1>
</header>

<div class="container">
    <h2>Modifier les informations de la recommandation</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="updateRecommandation.php?id_rec=<?php echo $recommandation['id_rec']; ?>" method="POST">
        <input type="hidden" name="id_rec" value="<?php echo $recommandation['id_rec']; ?>">
        
        <label for="quantite_eau">Quantité d'eau :</label>
        <input type="text" id="quantite_eau" name="quantite_eau" value="<?php echo $recommandation['quantite_eau']; ?>" required>

        <label for="duree_arrosage">Durée d'arrosage :</label>
        <input type="text" id="duree_arrosage" name="duree_arrosage" value="<?php echo $recommandation['duree_arrosage']; ?>" required>

        <label for="type_arrosage">Type d'arrosage :</label>
        <input type="text" id="type_arrosage" name="type_arrosage" value="<?php echo $recommandation['type_arrosage']; ?>" required>

        <label for="type_plante">Type de plante :</label>
        <input type="text" id="type_plante" name="type_plante" value="<?php echo $recommandation['type_plante']; ?>" required>

        <input type="submit" value="Mettre à Jour">
    </form>
</div>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>
