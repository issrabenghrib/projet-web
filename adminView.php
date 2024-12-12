<?php
require __DIR__ . '/../model/WeatherService.php';
require_once __DIR__ . '/../controller/MeteoController.php';

// Database configuration
$host = 'localhost';
$dbname = 'meteo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $weatherService = new WeatherService($pdo);

    // Retrieve all alerts
    $alertes = $weatherService->getAllAlerts();

    // Add an alert
    if (isset($_POST['add'])) {
        $dateAlerte = $_POST['date_alerte'];
        $quantiteEau = $_POST['quantite_eau'];
        $weatherService->addAlert($dateAlerte, $quantiteEau);
        header("Location: admin.php"); // Redirect to avoid form resubmission
        exit;
    }

    // Edit an alert
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $alerte = $weatherService->getAlertById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dateAlerte = $_POST['date_alerte'];
            $quantiteEau = $_POST['quantite_eau'];
            $weatherService->updateAlert($id, $dateAlerte, $quantiteEau);
            header("Location: admin.php");
            exit;
        }
    }

    // Delete an alert
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $weatherService->deleteAlert($id);
        header("Location: admin.php");
        exit;
    }

    // Assuming $pdo is your PDO database connection instance
    try {
        $stmt = $pdo->query("SELECT id, date, temperature, humidite, pluie FROM prediction ORDER BY date ASC");
        $meteoData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Could not fetch prediction data: " . $e->getMessage());
    }

    // Handle Météo actions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'delete':
                    if (isset($_POST['id'])) {
                        // Add your delete logic here
                        $stmt = $pdo->prepare("DELETE FROM prediction WHERE id = ?");
                        $stmt->execute([$_POST['id']]);
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }
                    break;
                
                case 'edit':
                    if (isset($_POST['id'])) {
                        // Add your edit logic here
                        // You might want to redirect to an edit page or show a modal
                    }
                    break;
                    
                case 'delete_alert':
                    if (isset($_POST['alert_id'])) {
                        $weatherService->deleteAlert($_POST['alert_id']);
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }
                    break;
                    
                case 'edit_alert':
                    if (isset($_POST['alert_id'])) {
                        // Add your alert edit logic here
                        // You might want to redirect to an edit page or show a modal
                    }
                    break;
            }
        }
    }

    // Add this edit handling code
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        $id = $_POST['id'];
        $editRecord = null;
        
        // Fetch the record to edit
        $stmt = $pdo->prepare("SELECT * FROM prediction WHERE id = ?");
        $stmt->execute([$id]);
        $editRecord = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Add this update handling code
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $id = $_POST['id'];
        $date = $_POST['date'];
        $temperature = $_POST['temperature'];
        $humidite = $_POST['humidite'];
        $pluie = $_POST['pluie'];
        
        $stmt = $pdo->prepare("UPDATE prediction SET date = ?, temperature = ?, humidite = ?, pluie = ? WHERE id = ?");
        $stmt->execute([$date, $temperature, $humidite, $pluie, $id]);
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Add this alert edit handling code after your existing edit handling code
    if (isset($_POST['action']) && $_POST['action'] === 'edit_alert') {
        $alert_id = $_POST['alert_id'];
        $editAlert = null;
        
        // Fetch the alert to edit
        $editAlert = $weatherService->getAlertById($alert_id);
    }

    // Add this alert update handling code
    if (isset($_POST['action']) && $_POST['action'] === 'update_alert') {
        $alert_id = $_POST['alert_id'];
        $date_alerte = $_POST['date_alerte'];
        $quantite_eau = $_POST['quantite_eau'];
        
        $weatherService->updateAlert($alert_id, $date_alerte, $quantite_eau);
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // Add this to your existing PHP action handlers
    if (isset($_POST['action']) && $_POST['action'] === 'add_meteo') {
        $date = $_POST['date'];
        $temperature = $_POST['temperature'];
        $humidite = $_POST['humidite'];
        $pluie = $_POST['pluie'];
        
        try {
            $stmt = $pdo->prepare("INSERT INTO prediction (date, temperature, humidite, pluie) VALUES (?, ?, ?, ?)");
            $stmt->execute([$date, $temperature, $humidite, $pluie]);
            
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Farm to Future - Administration</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            width: 95%;
            margin: 20px auto;
            padding: 20px;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .section {
            background: white;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .section-title {
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .form-actions .btn {
            min-width: 100px;
        }

        .section canvas {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Farm to Future - Administration</h1>
        </header>

        <!-- Météo Section -->
        <section class="section">
            <h2 class="section-title">Données Météorologiques</h2>
            
            <!-- Add Button -->
            <button onclick="showAddMeteoForm()" class="btn btn-primary" style="margin-bottom: 20px;">
                Ajouter une entrée
            </button>

            <!-- Add Form Modal -->
            <div id="addMeteoModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <h3>Ajouter une entrée météorologique</h3>
                    <form method="post">
                        <input type="hidden" name="action" value="add_meteo">
                        
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="temperature">Température (°C):</label>
                            <input type="number" step="0.1" name="temperature" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="humidite">Humidité (%):</label>
                            <input type="number" step="0.1" name="humidite" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pluie">Pluie (mm):</label>
                            <input type="number" step="0.1" name="pluie" required>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                            <button type="button" onclick="hideAddMeteoForm()" class="btn btn-danger">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Température</th>
                        <th>Humidité</th>
                        <th>Pluie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($meteoData)): ?>
                        <?php foreach ($meteoData as $record): ?>
                            <tr>
                                <td><?= htmlspecialchars($record['date']) ?></td>
                                <td><?= htmlspecialchars($record['temperature']) ?>°C</td>
                                <td><?= htmlspecialchars($record['humidite']) ?>%</td>
                                <td>
                                    <?php 
                                        if (isset($record['pluie']) && $record['pluie'] !== null) {
                                            echo htmlspecialchars($record['pluie']) . ' mm';
                                        } else {
                                            echo '0 mm';  // or '-' if you prefer
                                        }
                                    ?>
                                </td>
                                <td class="actions">
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="id" value="<?= $record['id'] ?>">
                                        <button type="submit" name="action" value="edit" class="btn btn-primary">Modifier</button>
                                    </form>
                                    <form method="post" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette entrée ?');">
                                        <input type="hidden" name="id" value="<?= $record['id'] ?>">
                                        <button type="submit" name="action" value="delete" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Aucune donnée disponible</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <!-- Graphique des Températures -->
        <section class="section">
            <h2 class="section-title">Graphique des Températures</h2>
            <div style="width: 100%; height: 400px;">
                <canvas id="temperatureChart"></canvas>
            </div>
        </section>

        <!-- Alertes Section -->
        <section class="section">
            <h2 class="section-title">Gestion des Alertes</h2>
            
            <!-- Formulaire d'ajout d'alerte -->
            <form action="" method="POST" class="form-group">
                <h3>Ajouter une Alerte</h3>
                <div class="form-group">
                    <label for="date_alerte">Date de l'Alerte:</label>
                    <input type="date" id="date_alerte" name="date_alerte" required>
                </div>
                <div class="form-group">
                    <label for="quantite_eau">Quantité d'Eau (mm):</label>
                    <input type="number" id="quantite_eau" name="quantite_eau" required>
                </div>
                <button type="submit" name="add" class="btn btn-primary">Ajouter l'Alerte</button>
            </form>

            <!-- Liste des alertes -->
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Quantité d'Eau</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($alertes)): ?>
                        <?php foreach ($alertes as $alerte): ?>
                            <tr>
                                <td><?= htmlspecialchars($alerte['date_alerte']) ?></td>
                                <td><?= htmlspecialchars($alerte['quantite_eau']) ?> mm</td>
                                <td class="actions">
                                    <form method="post" style="display: inline;">
                                        <input type="hidden" name="alert_id" value="<?= $alerte['id'] ?>">
                                        <button type="submit" name="action" value="edit_alert" class="btn btn-primary">Modifier</button>
                                    </form>
                                    <form method="post" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette alerte ?');">
                                        <input type="hidden" name="alert_id" value="<?= $alerte['id'] ?>">
                                        <button type="submit" name="action" value="delete_alert" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Aucune alerte disponible</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <!-- Add this edit form section just before the closing </div> of the container -->
        <?php if (isset($editRecord)): ?>
            <div class="modal" style="display: block;">
                <div class="modal-content">
                    <h3>Modifier l'entrée</h3>
                    <form method="post">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?= $editRecord['id'] ?>">
                        
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" name="date" value="<?= $editRecord['date'] ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="temperature">Température:</label>
                            <input type="number" step="0.1" name="temperature" value="<?= $editRecord['temperature'] ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="humidite">Humidité:</label>
                            <input type="number" step="0.1" name="humidite" value="<?= $editRecord['humidite'] ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="pluie">Pluie:</label>
                            <input type="number" step="0.1" name="pluie" value="<?= $editRecord['pluie'] ?>" required>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Add this edit form for alerts just before the closing </div> of the container -->
        <?php if (isset($editAlert)): ?>
            <div class="modal" style="display: block;">
                <div class="modal-content">
                    <h3>Modifier l'Alerte</h3>
                    <form method="post">
                        <input type="hidden" name="action" value="update_alert">
                        <input type="hidden" name="alert_id" value="<?= $editAlert['id'] ?>">
                        
                        <div class="form-group">
                            <label for="date_alerte">Date de l'Alerte:</label>
                            <input type="date" name="date_alerte" value="<?= $editAlert['date_alerte'] ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="quantite_eau">Quantité d'Eau (mm):</label>
                            <input type="number" step="0.1" name="quantite_eau" value="<?= $editAlert['quantite_eau'] ?>" required>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
    function showAddMeteoForm() {
        document.getElementById('addMeteoModal').style.display = 'block';
    }

    function hideAddMeteoForm() {
        document.getElementById('addMeteoModal').style.display = 'none';
    }
    </script>

    <!-- Add this JavaScript code before the closing </body> tag -->
    <script>
    // Validation functions
    function validateMeteoForm(form) {
        const date = form.querySelector('input[name="date"]').value;
        const temperature = parseFloat(form.querySelector('input[name="temperature"]').value);
        const humidite = parseFloat(form.querySelector('input[name="humidite"]').value);
        const pluie = parseFloat(form.querySelector('input[name="pluie"]').value);

        // Date validation
        if (!date) {
            alert('La date est obligatoire');
            return false;
        }

        // Temperature validation (-50 to 50 degrees Celsius)
        if (isNaN(temperature) || temperature < -50 || temperature > 50) {
            alert('La température doit être comprise entre -50°C et 50°C');
            return false;
        }

        // Humidity validation (0 to 100%)
        if (isNaN(humidite) || humidite < 0 || humidite > 100) {
            alert('L\'humidité doit être comprise entre 0% et 100%');
            return false;
        }

        // Rain validation (non-negative)
        if (isNaN(pluie) || pluie < 0) {
            alert('La quantité de pluie ne peut pas être négative');
            return false;
        }

        return true;
    }

    function validateAlertForm(form) {
        const dateAlerte = form.querySelector('input[name="date_alerte"]').value;
        const quantiteEau = parseFloat(form.querySelector('input[name="quantite_eau"]').value);

        // Date validation
        if (!dateAlerte) {
            alert('La date est obligatoire');
            return false;
        }

        // Water quantity validation (non-negative)
        if (isNaN(quantiteEau) || quantiteEau < 0) {
            alert('La quantité d\'eau ne peut pas être négative');
            return false;
        }

        return true;
    }

    // Modal functions
    function showAddMeteoForm() {
        document.getElementById('addMeteoModal').style.display = 'block';
    }

    function hideAddMeteoForm() {
        document.getElementById('addMeteoModal').style.display = 'none';
    }

    // Add event listeners to all forms
    document.addEventListener('DOMContentLoaded', function() {
        // Meteo add form
        const addMeteoForm = document.querySelector('form[action="add_meteo"]');
        if (addMeteoForm) {
            addMeteoForm.onsubmit = function(e) {
                return validateMeteoForm(this);
            };
        }

        // Meteo edit form
        const editMeteoForm = document.querySelector('form[action="update"]');
        if (editMeteoForm) {
            editMeteoForm.onsubmit = function(e) {
                return validateMeteoForm(this);
            };
        }

        // Alert add form
        const addAlertForm = document.querySelector('form[action="add"]');
        if (addAlertForm) {
            addAlertForm.onsubmit = function(e) {
                return validateAlertForm(this);
            };
        }

        // Alert edit form
        const editAlertForm = document.querySelector('form[action="update_alert"]');
        if (editAlertForm) {
            editAlertForm.onsubmit = function(e) {
                return validateAlertForm(this);
            };
        }

        // Add input validation for number fields
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9.-]/g, '');
            });
        });
    });

    // Add real-time validation feedback
    function addInputValidation() {
        // Temperature validation
        document.querySelectorAll('input[name="temperature"]').forEach(input => {
            input.addEventListener('input', function() {
                const temp = parseFloat(this.value);
                if (isNaN(temp) || temp < -50 || temp > 50) {
                    this.style.borderColor = 'red';
                    this.title = 'La température doit être comprise entre -50°C et 50°C';
                } else {
                    this.style.borderColor = 'green';
                    this.title = '';
                }
            });
        });

        // Humidity validation
        document.querySelectorAll('input[name="humidite"]').forEach(input => {
            input.addEventListener('input', function() {
                const hum = parseFloat(this.value);
                if (isNaN(hum) || hum < 0 || hum > 100) {
                    this.style.borderColor = 'red';
                    this.title = 'L\'humidité doit être comprise entre 0% et 100%';
                } else {
                    this.style.borderColor = 'green';
                    this.title = '';
                }
            });
        });

        // Rain validation
        document.querySelectorAll('input[name="pluie"], input[name="quantite_eau"]').forEach(input => {
            input.addEventListener('input', function() {
                const rain = parseFloat(this.value);
                if (isNaN(rain) || rain < 0) {
                    this.style.borderColor = 'red';
                    this.title = 'La quantité ne peut pas être négative';
                } else {
                    this.style.borderColor = 'green';
                    this.title = '';
                }
            });
        });
    }

    // Call the function when the page loads
    document.addEventListener('DOMContentLoaded', addInputValidation);
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the canvas element
        const ctx = document.getElementById('temperatureChart').getContext('2d');

        // Prepare the data
        const meteoData = <?php echo json_encode($meteoData); ?>;
        const dates = meteoData.map(record => record.date);
        const temperatures = meteoData.map(record => record.temperature);

        // Create the chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Température (°C)',
                    data: temperatures,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Température (°C)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Évolution de la Température'
                    },
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    });
    </script>
</body>
</html>