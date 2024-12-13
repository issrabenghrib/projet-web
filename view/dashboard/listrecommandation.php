<?php
include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RecommandationController.php';

// Créer une instance du contrôleur
$recommandationC = new RecommandationController();
$listeRecommandations = [];
$afficher = 'non';

// Vérifier si une recherche a été effectuée
@$keywords = $_GET["keywords"];
@$valider = $_GET["valider"];

if(isset($valider) && !empty(trim($keywords))) {
    try {
        // Utiliser l'instance existante du contrôleur
        $listeRecommandations = $recommandationC->rechercherParQuantiteEau($keywords);
        $afficher = 'oui';
    } catch(Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Si pas de recherche, afficher toutes les recommandations
    $listeRecommandations = $recommandationC->listrecommandations();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Recommandations</title>
    <style>
        /* Le CSS reste identique à votre code original */
        body {
    background: #fff;
    color: #444;
    font-family: "Open Sans", sans-serif;
    margin: 0;
    padding: 0;
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

        .add-btn {
            display: inline-block;
            margin: 15px 0;
            padding: 8px 15px;
            background-color: #50d8af;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        form {
            margin: 15px 0;
            text-align: center;
        }

        input[type="text"] {
            padding: 5px;
            margin-right: 5px;
        }

        input[type="submit"] {
            padding: 5px 10px;
            background-color: #50d8af;
            color: white;
            border: none;
            cursor: pointer;
        }

        #resultats {
            text-align: center;
            margin: 10px 0;
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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="index.php?page=recommendations">Recommendations</a></li>
            <li><a href="index.php?page=requete">Requêtes</a></li>
        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="table-wrapper">
                            <div class="table-container">
                                <?php
                                // Logique pour inclure les fichiers en fonction de la page demandée
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                    if ($page === 'recommendations') {
                                        include_once 'listrecommandation.php';
                                    } elseif ($page === 'requete') {
                                        include_once 'listRequete.php';
                                    } else {
                                        echo "<p>Page non trouvée.</p>";
                                    }
                                } else {
                                    echo "<p>Bienvenue dans le tableau de bord !</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>

    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

        <div id="content-wrapper">
            <form name='fo' method='get' action='listrecommandation.php'>
                <input type="text" name="keywords" value="<?php echo htmlspecialchars($keywords ?? ''); ?>" placeholder="Rechercher par quantité d'eau" />
                <input type='submit' name='valider' value='rechercher' />
            </form>

            <?php if ($afficher == 'oui'): ?>
            <div id="resultats">
                <div id='nbr'><?= count($listeRecommandations) ?> résultat(s) trouvé(s)</div>
            </div>
            <?php endif; ?>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Quantité d'eau</th>
                            <th>Durée d'arrosage</th>
                            <th>Type d'arrosage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listeRecommandations)) { ?>
                            <tr>
                                <td colspan="5">Aucune recommandation trouvée.</td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($listeRecommandations as $recommandation) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($recommandation['id_rec']); ?></td>
                                    <td><?= htmlspecialchars($recommandation['quantite_eau']); ?></td>
                                    <td><?= htmlspecialchars($recommandation['duree_arrosage']); ?></td>
                                    <td><?= htmlspecialchars($recommandation['type_arrosage']); ?></td>
                                    <td>
                                        <a href="updateRecommandation.php?id_rec=<?= urlencode($recommandation['id_rec']); ?>">Modifier</a>
                                        <a href="deleteRecommandation.php?id_rec=<?= urlencode($recommandation['id_rec']); ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <a href="addrecommandation.php" class="add-btn">Ajouter une nouvelle recommandation</a>
        </div>
    </div>
</body>
</html>