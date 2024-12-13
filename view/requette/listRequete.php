<?php
include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RequeteController.php';
include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\view\dashboard\index.php';
$requeteC = new RequeteController();
$listeRequetes = $requeteC->listRequetes();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Requêtes</title>
    <style>
        /* CSS Global */
        body {
            background: #fff;
            color: #444;
            font-family: "Open Sans", sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
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

        p {
            padding: 0;
            margin: 0 0 30px 0;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: "Montserrat", sans-serif;
            font-weight: 400;
            margin: 0 0 20px 0;
            padding: 0;
        }

        /*-------------------------------------------------------------- 
        Back to top button
        --------------------------------------------------------------*/
        .back-to-top {
            position: fixed;
            display: none;
            background: #50d8af;
            color: #fff;
            padding: 6px 12px 9px 12px;
            font-size: 16px;
            border-radius: 2px;
            right: 15px;
            bottom: 15px;
            transition: background 0.5s;
        }

        @media (max-width: 768px) {
            .back-to-top {
                bottom: 15px;
            }
        }

        .back-to-top:focus {
            background: #50d8af;
            color: #fff;
            outline: none;
        }

        .back-to-top:hover {
            background: #0c2e8a;
            color: #fff;
        }

        /*-------------------------------------------------------------- 
        Table styles
        --------------------------------------------------------------*/
        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #50d8af; /* Bordure colorée */
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #50d8af; /* Vert */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Ligne paire de fond gris clair */
        }

        tr:hover {
            background-color: #e6fffb; /* Légère teinte au survol */
        }

        .actions a {
            text-decoration: none;
            color: #50d8af; /* Vert clair */
            padding: 5px 10px;
            border: 1px solid #50d8af;
            border-radius: 4px;
            margin: 5px;
            transition: background-color 0.3s ease;
        }

        .actions a:hover {
            background-color: #0c2e8a; /* Bleu foncé au survol */
            color: white;
        }

        .add-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #50d8af; /* Bouton vert */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .add-btn:hover {
            background-color: #0c2e8a; /* Bleu foncé */
        }

        /*-------------------------------------------------------------- 
        Header and Footer
        --------------------------------------------------------------*/
        #header {
            padding: 20px 0;
            height: 84px;
            transition: all 0.5s;
            z-index: 997;
            background: #fff;
            box-shadow: 0px 6px 9px 0px rgba(0, 0, 0, 0.06);
        }

        #header #logo h1 {
            font-size: 42px;
            margin: 0;
            padding: 0;
            line-height: 1;
            font-family: "Montserrat", sans-serif;
            font-weight: 700;
        }

        #header #logo h1 a {
            color: #0c2e8a;
            line-height: 1;
            display: inline-block;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
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
<table>
    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Type de Requête</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($listeRequetes as $requete) { ?>
    <tr>
        <td><?= $requete['id_requete']; ?></td>
        <td><?= $requete['date']; ?></td>
        <td><?= $requete['type_de_requete']; ?></td>
        <td class="actions">
            <a href="updaterequete.php?id_requete=<?= $requete['id_requete']; ?>">Modifier</a>
            <a href="deleterequete.php?id_requete=<?php echo urlencode($requete['id_requete']); ?>">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>

<a href="addRequete.php" class="add-btn">Ajouter une nouvelle requête</a>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>
