<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RecommandationController.php'; // Inclure le contrôleur de recommandation

// Vérifier si l'ID de la recommandation est présent dans l'URL
if (isset($_GET['id_rec']) && !empty($_GET['id_rec'])) {
    $id_rec = $_GET['id_rec']; // Récupérer l'ID de la recommandation depuis l'URL

    // Débogage : afficher l'ID récupéré
    echo "ID retrieved: " . $id_rec;

    // Instancier le contrôleur de recommandation et supprimer la recommandation
    $recommandationController = new RecommandationController();
    $recommandationController->deleteRecommandation($id_rec); // Appeler la méthode de suppression

    // Rediriger vers la liste des recommandations après suppression
    header("Location: listRecommandation.php");
    exit;
} else {
    // Afficher un message d'erreur si l'ID n'est pas fourni
    echo "<p style='color: red; text-align: center;'>Error: No ID provided.</p>";
    echo "<a href='listRecommandation.php'>Go back to the list</a>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Recommandation</title>
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
        
/* Conteneur principal pour centrer le contenu et ajuster la position */
.table-wrapper {
    display: flex;
    justify-content: center; /* Centre horizontalement */
    align-items: center; /* Centre verticalement */
    margin: 0 auto; /* Centre le conteneur lui-même */
    padding: 20px;
    width: 100%;
    min-height: 100vh; /* Utilise toute la hauteur de la vue */
} 

.table-container {
    width: 80%;
    max-width: 1200px; /* Limite la largeur maximale */
    margin: 0 auto;
}

.add-container {
    width: 80%;
    max-width: 1200px;
    margin: 20px auto;
    display: flex;
    justify-content: center;
}

/* Pour les tables */
.table-wrapper .table-container {
    margin: 0 auto;
    width: 100%;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px auto; /* Centre la table */
}

/* Style des cellules */
th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

/* Style pour les en-têtes */
th {
    background-color: #50d8af;
    color: white;
}

/* Style des lignes alternées */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Effet au survol */
tr:hover {
    background-color: #e6fffb;
}

/* Bouton pour ajouter des éléments */
.add-btn {
    display: block; /* Change en block pour permettre margin auto */
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #50d8af;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    text-align: center;
    width: fit-content;
}

/* Effet au survol du bouton */
.add-btn:hover {
    background-color: #0c2e8a;
}

/* Pied de page */
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}

/* Conteneur général pour la page */
#content-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    margin: 0 auto;
}

/* Barre latérale */
.sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    background-color: #343a40;
    color: white;
}
    </style>
    
</head>
<body>

<header>
    <h1>Confirm Deletion</h1>
</header>

<div class="container">
    <h2>Are you sure you want to delete this recommendation?</h2>
    <div class="buttons">
        <a href="listRecommandation.php" class="cancel">Cancel</a>
        <a href="?id_rec=<?php echo $_GET['id_rec']; ?>" class="confirm">Confirm</a>
    </div>
</div>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>
