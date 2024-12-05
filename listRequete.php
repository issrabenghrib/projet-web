<?PHP
include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RequeteController.php';

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
            margin: 0;
            padding: 0;
        }

        /* Styles de la table */
        table {
            width: 100%;
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

        /* Barre de navigation et pied de page */
        #content-wrapper {
            margin-left: 300px; /* Ajout de l'espace pour la sidebar */
            padding: 20px;
            padding-top: 40px; /* Marge supérieure */
        }

        .table-wrapper {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            margin-left: 250px; /* Décale à droite en fonction de la largeur de la sidebar */
            padding: 20px;
            width: calc(100% - 250px);
            margin-top: 80px; /* Ajoute de l'espace pour déplacer la table vers le bas */
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
    </style>
</head>
<body>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="table-wrapper">
                    <div class="table-container">
                        <!-- Table des requêtes -->
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
                        <!-- Bouton Ajouter -->
                        <a href="addRequete.php" class="add-btn">Ajouter une nouvelle requête</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>