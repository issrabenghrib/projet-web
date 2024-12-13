<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RequeteController.php';

$error = "";
$requeteController = new RequeteController();

// Vérifier si l'ID est passé en paramètre
if (isset($_GET['id_requete']) && !empty($_GET['id_requete'])) {
    $id_requete = $_GET['id_requete'];
    $requete = $requeteController->getRequeteById($id_requete);
    if (!$requete) {
        $error = "Requête introuvable.";
    }
} else {
    $error = "Erreur : Aucun ID fourni.";
    exit;
}

// Gérer la mise à jour après soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_requete = $_POST['id_requete'];
    $date = $_POST['date'];
    $type_de_requete = $_POST['type_de_requete'];

    $requete = new Requete(
        $id_requete,
        $date,
        $type_de_requete,
        $statut,
        $db
    );

    try {
        $requeteController->updateRequete($requete, $id_requete);
        header('Location: listRequete.php');
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
    <title>Mettre à Jour Requête</title>
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
            margin: 20px 0;
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

<header>
    <h1>Mettre à Jour une Requête</h1>
</header>

<div class="container">
    <h2>Modifier les informations de la requête</h2>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="updaterequete.php?id_requete=<?php echo $requete['id_requete']; ?>" method="POST">
        <input type="hidden" name="id_requete" value="<?php echo $requete['id_requete']; ?>">
        
        <label for="date">Date :</label>
        <input type="date" id="date" name="date" value="<?php echo $requete['date']; ?>" required>

        <label for="type_de_requete">Type de Requête :</label>
        <input type="text" id="type_de_requete" name="type_de_requete" value="<?php echo $requete['type_de_requete']; ?>" required>

        <input type="submit" value="Mettre à Jour">
    </form>
</div>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>