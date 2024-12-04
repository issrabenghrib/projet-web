<?php
include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RecommandationController.php';
include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\view\dashboard\index.html';


// Créer une instance de RecommandationController
$recommandationC = new RecommandationController();
$listeRecommandations = $recommandationC->listrecommandations();
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
    display: flex; /* Flexbox pour contrôler la position */
    justify-content: flex-start; /* Place le contenu à gauche */
    align-items: flex-start; /* Place le contenu en haut */
    margin-left: 250px; /* Décale à droite en fonction de la largeur de la barre latérale */
    padding: 20px; /* Ajoute un peu d'espace intérieur */
    width: calc(100% - 250px); /* Assure que le conteneur occupe l'espace restant */
}

/* Pour les tables */
.table-wrapper .table-container {
    margin: 0 auto; /* Centrage automatique horizontal */
    max-width: 80%; /* Assure que la table ne déborde pas */
}

/* Ajustements si nécessaire pour la table */
.table-wrapper table {
    width: 100%;
    border-collapse: collapse; /* Fusion des bordures */
}


/* Style des cellules */
th, td {
    padding: 15px;
    text-align: left;
    border: 1px solid #50d8af; /* Bordure verte */
}

/* Style pour les en-têtes */
th {
    background-color: #50d8af; /* Couleur verte pour les en-têtes */
    color: white; /* Texte en blanc */
}

/* Style des lignes alternées */
tr:nth-child(even) {
    background-color: #f2f2f2; /* Gris clair pour les lignes paires */
}

/* Effet au survol */
tr:hover {
    background-color: #e6fffb; /* Vert clair pour le survol */
}

/* Bouton pour ajouter des éléments */
.add-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #50d8af; /* Vert pour le bouton */
    color: white; /* Texte blanc */
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease; /* Effet de transition */
}

/* Effet au survol du bouton */
.add-btn:hover {
    background-color: #0c2e8a; /* Bleu foncé pour le hover */
}

/* Pied de page */
footer {
    background-color: #333; /* Fond noir */
    color: white; /* Texte blanc */
    text-align: center; /* Centre le texte */
    padding: 10px; /* Ajoute de l'espace interne */
    position: fixed; /* Fixe le pied de page */
    width: 100%; /* Occupe toute la largeur */
    bottom: 0; /* Positionne en bas */
}

/* Conteneur général pour la page (ajustement avec sidebar) */
#content-wrapper {
    margin-left: 300px; /* Assurez-vous que cela prend en compte la largeur de la sidebar */
    padding: 20px;
    padding-top: 40px; /* Ajoute de l'espace au-dessus du contenu */
}


/* Barre latérale */
.sidebar {
    width: 250px; /* Fixe la largeur de la sidebar */
    position: fixed; /* Position fixe */
    top: 0;
    left: 0;
    height: 100%; /* Occupe toute la hauteur */
    background-color: #343a40; /* Couleur sombre */
    color: white; /* Texte blanc */
}
   </style>
</head>
<body>

<table>
    <tr>
        <th>ID</th>
        <th>Quantité d'eau</th>
        <th>Durée d'arrosage</th>
        <th>Type d'arrosage</th>
        <th>ID de Requête</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($listeRecommandations as $recommandation) { ?>
    <tr>
        <td><?= htmlspecialchars($recommandation['id_rec']); ?></td>
        <td><?= htmlspecialchars($recommandation['quantite_eau']); ?></td>
        <td><?= htmlspecialchars($recommandation['duree_arrosage']); ?></td>
        <td><?= htmlspecialchars($recommandation['type_arrosage']); ?></td>
        <td><?= htmlspecialchars($recommandation['id_requete']); ?></td>
        <td class="actions">
            <a href="updateRecommandation.php?id_rec=<?= urlencode($recommandation['id_rec']); ?>">Modifier</a>
            <a href="deleteRecommandation.php?id_rec=<?= urlencode($recommandation['id_rec']); ?>">Supprimer</a>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="addrecommandation.php" class="add-btn">Ajouter une nouvelle recommandation</a>


<footer>
    <p>&copy; 2024 Votre Société | Tous droits réservés</p>
</footer>

</body>
</html>
