<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RequeteController.php';  // Ensure your config file is included for DB connection

// Retrieve the ID from the URL
/*if (isset($_GET['id_requete'])&& !empty($_GET['id_requete'])) {
    $id_requete = $_GET['id_requete'];
    echo "ID retrieved from URL: " . $id_requete;
} else {
    echo "<p style='color: red;'>Error: ID not found in URL.</p>";
    exit;
    include_once 'RequeteController.php';
*/
// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id_requete']) && !empty($_GET['id_requete'])) {
    $id_requete = $_GET['id_requete'];

    // Débogage : afficher l'ID récupéré
    echo "ID retrieved: " . $id_requete;

    // Instancier le contrôleur et supprimer la requête
    $requeteController = new RequeteController();
    $requeteController->deleteRequete($id_requete);

    // Rediriger vers la liste des requêtes après suppression
    header("Location: listRequete.php");
    exit;
} else {
    // Afficher un message d'erreur si l'ID n'est pas fourni
    echo "<p style='color: red; text-align: center;'>Error: No ID provided.</p>";
    echo "<a href='listRequete.php'>Go back to the list</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Requete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #f44336;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .buttons a {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-weight: bold;
        }

        .cancel {
            background-color: #ccc;
        }

        .confirm {
            background-color: #f44336;
        }

        .cancel:hover {
            background-color: #bbb;
        }

        .confirm:hover {
            background-color: #e53935;
        }

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

<header>
    <h1>Confirm Deletion</h1>
</header>


