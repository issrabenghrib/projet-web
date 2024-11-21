<?php
include_once '../controller/requestController.php';  // Ensure your config file is included for DB connection

// Create an instance of the RequeteController
$requeteController = new RequeteController();

// Fetch the list of requetes
$list = $requeteController->listRequete();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requete List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 0;
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            text-decoration: none;
            color: #f44336;
            font-weight: bold;
        }

        td a:hover {
            color: #e53935;
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

        /* Additional improvements */
        .container p {
            font-size: 16px;
            color: #555;
        }

        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <h1>List of Requetes</h1>
</header>

<div class="container">
    <h2>All Requetes</h2>
    
    <?php if (empty($list)): ?>
        <p>No requetes found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Type of Request</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $requete): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($requete['id_requete']); ?></td>
                        <td><?php echo htmlspecialchars($requete['date']); ?></td>
                        <td><?php echo htmlspecialchars($requete['type_de_requete']); ?></td>
                        <td><a href="deleteRequete.php?id_requete=<?php echo htmlspecialchars($requete['id_requete']); ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Your Company | All Rights Reserved</p>
</footer>

</body>
</html>
