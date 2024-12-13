<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RequeteController.php';  
$error = "";
$requete = null;

// Create an instance of the controller
$requeteController = new RequeteController();

if (
    isset($_POST["date"], $_POST["type_de_requete"]) &&
    !empty($_POST["date"]) && 
    !empty($_POST["type_de_requete"])
) {
    try {
        // Optional: Retrieve ID
        $id = !empty($_POST["id_requete"]) ? $_POST["id_requete"] : null;

        // Optional validation for ID
        if ($id !== null && !is_numeric($id)) {
            throw new Exception("The ID must be numeric.");
        }

       
        // Add the new requete via the controller
        $requeteController->addRequete($requete);

        // Redirect to the requete list page
        header('Location: listRequete.php');
        
        exit;
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
} else {
    $error = "Missing or invalid information.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Requête</title>
    <style>
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
<body>



<div class="container">
    <h2>Créer une nouvelle requête</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="addrequete.php">
        <label for="id_requete">ID :</label>
        <input type="text" name="id_requete" id="id_requete" placeholder="Laisser vide pour auto-génération"><br>

        <label for="date">Date :</label>
        <input type="date" name="date" id="date" required><br>

        <label for="type_de_requete">Type de Requête :</label>
        <input type="text" name="type_de_requete" id="type_de_requete" required><br>

        <input type="submit" value="Ajouter une Requête">
    </form>

    <?php if (!empty($requete)): ?>
        <div class="success">Requête ajoutée avec succès !</div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>
