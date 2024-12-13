<?php
/*include 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\RequeteController.php';
$requeteC = new RequeteController();
$listeRequetes = $requeteC->listRequetes();

// Calcul des statistiques
$totalRequetes = count($listeRequetes);
$typesRequetes = [];
foreach ($listeRequetes as $requete) {
    $type = $requete['type_de_requete'];
    if (!isset($typesRequetes[$type])) {
        $typesRequetes[$type] = 0;
    }
    $typesRequetes[$type]++;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container-fluid">
        <!-- Barre de navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="addRequete.php">Ajouter une requête</a></li>
                </ul>
            </div>
        </nav>

        <!-- Statistiques -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Total des Requêtes</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalRequetes; ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Types de Requêtes</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php foreach ($typesRequetes as $type => $count) { ?>
                                <li class="list-group-item bg-success text-white"><?= $type; ?> : <?= $count; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphique -->
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="typeChart"></canvas>
            </div>
        </div>

        <!-- Tableau des données -->
        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Type de Requête</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeRequetes as $requete) { ?>
                        <tr>
                            <td><?= $requete['id_requete']; ?></td>
                            <td><?= $requete['date']; ?></td>
                            <td><?= $requete['type_de_requete']; ?></td>
                            <td>
                                <a href="updaterequete.php?id_requete=<?= $requete['id_requete']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="deleterequete.php?id_requete=<?= $requete['id_requete']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="addRequete.php" class="btn btn-primary">Ajouter une nouvelle requête</a>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script>
        const ctx = document.getElementById('typeChart').getContext('2d');
        const typeChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?= json_encode(array_keys($typesRequetes)); ?>,
                datasets: [{
                    data: <?= json_encode(array_values($typesRequetes)); ?>,
                    backgroundColor: ['#0c2e8a', '#50d8af', '#f39c12', '#e74c3c'],
                }]
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
