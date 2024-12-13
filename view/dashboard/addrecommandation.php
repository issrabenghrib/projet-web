<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RecommandationController.php';
$error = "";
$recommandation = null;

// Create an instance of the controller
$recommandationController = new RecommandationController();

if (
    isset($_POST["quantite_eau"], $_POST["duree_arrosage"], $_POST["type_arrosage"]) &&
    !empty($_POST["quantite_eau"]) && 
    !empty($_POST["duree_arrosage"]) &&
    !empty($_POST["type_arrosage"])
    
) {
    try {
        // Optional: Retrieve ID
        $id = !empty($_POST["id_rec"]) ? $_POST["id_rec"] : null;

        // Optional validation for ID
        if ($id !== null && !is_numeric($id)) {
            throw new Exception("L'ID doit être un entier.");
        }

        // Create a new Recommandation object
        $recommandation = new Recommandation(
            $id,
            $_POST["quantite_eau"],
            $_POST["duree_arrosage"],
            $_POST["type_arrosage"],
           
        );

        // Add the new recommandation via the controller
        $recommandationController->addrecommandation($recommandation);

        // Redirect to the recommandation list page
        header('Location: listrecommandation.php');
        exit;
    } catch (Exception $e) {
        $error = "Une erreur s'est produite : " . $e->getMessage();
    }
} else {
    $error = "Des informations manquent ou sont invalides.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Recommandation</title>
    <style>
        /* Votre st <style>
        /* Global Styles */
        body {
            background: #fff;
            color: #444;
            font-family: "Open Sans", sans-serif;
        }

        a {
            color: #50d8af;
            transition: 0.5s;
        }

        a:hover, a:active, a:focus {
            color: #51d8af;
            outline: none;
            text-decoration: none;
        }

        h1, h2 {
            font-family: "Montserrat", sans-serif;
            margin: 0 0 20px 0;
        }

        /* Header Styles */
        header {
            padding: 20px 0;
            background: #fff;
            box-shadow: 0px 6px 9px rgba(0, 0, 0, 0.06);
            text-align: center;
        }

        header h1 {
            color: #0c2e8a;
        }

        /* Container Styles */
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #444;
        }

        input[type="date"],
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background: #50d8af;
            color: #fff;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #0c2e8a;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
        }

        /* Footer Styles */
        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    
</head>


<div class="container">
    <h2>Créer une nouvelle recommandation</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="addrecommandation.php">
        <label for="id_rec">ID :</label>
        <input type="text" name="id_rec" id="id_rec" placeholder="Laisser vide pour auto-génération"><br>

        <label for="quantite_eau">Quantité d'eau :</label>
        <input type="number" step="0.01" name="quantite_eau" id="quantite_eau" required><br>

        <label for="duree_arrosage">Durée d'arrosage :</label>
        <input type="text" name="duree_arrosage" id="duree_arrosage" required><br>

        <label for="type_arrosage">Type d'arrosage :</label>
        <input type="text" name="type_arrosage" id="type_arrosage" required><br>

        <button type="submit">Ajouter la recommandation</button>
        <a href="listrecommandation.php" class="btn-cancel">Annuler</a>
    </form>

    <?php if (!empty($recommandation)): ?>
        <div class="success">Recommandation ajoutée avec succès !</div>
        <script>
            // Redirection automatique après 2 secondes
            setTimeout(function() {
                window.location.href = 'listrecommandation.php';
            }, 2000);
        </script>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>
