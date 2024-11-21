<?php
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\requestController.php';  // Ensure your config file is included for DB connection

$error = "";
$requeteController = new RequeteController();

// Get the ID of the requete to update from the URL
if (isset($_GET['id_requete'])) {
    $id_requete = $_GET['id_requete'];
    $requete = $requeteController->getRequeteById($id_requete);  // This method should fetch the requete by ID
} else {
    echo "Error: No ID provided.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Requete</title>
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
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header>
    <h1>Update Requete</h1>
</header>

<div class="container">
    <h2>Update the Requete Information</h2>
    
    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form action="updateRequete.php" method="POST">
        <input type="hidden" name="id_requete" value="<?php echo $requete['id_requete']; ?>">
        
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $requete['date']; ?>" required>

        <label for="type_de_requete">Type of Request:</label>
        <input type="text" id="type_de_requete" name="type_de_requete" value="<?php echo $requete['type_de_requete']; ?>" required>

        <input type="submit" value="Update Requete">
    </form>
</div>

<footer>
    <p>&copy; 2024 Your Company | All Rights Reserved</p>
</footer>

</body>
</html>
