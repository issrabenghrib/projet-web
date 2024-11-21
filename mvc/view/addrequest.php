<?php

include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\controller\requestController.php';  // Ensure your config file is included for DB connection
$error = "";
$requete = null;

// Create an instance of the controller
$requeteController = new RequeteController();

if (
    isset($_POST["date"], $_POST["type_de_requete"]) &&
    !empty($_POST["date"]) && 
    !empty($_POST["type_de_requete"])
) {
    try {
        // Create a new Requete object
        $requete = new Requete(
            null, // Assuming the ID is auto-generated
            $_POST["date"],
            $_POST["type_de_requete"]
        );

        // Add the new requete via the controller
        $requeteController->addRequete($requete);

        // Redirect to the requete list page
        header('Location: requestList.php');
        exit;
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
} else {
    $error = "Missing or invalid information.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Requete</title>
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

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="date"],
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: green;
            text-align: center;
            margin-top: 10px;
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
    </style>
</head>
<body>

<header>
    <h1>Add Requete</h1>
</header>

<div class="container">
    <h2>Create a New Request</h2>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="addrequete.php">
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required><br>

        <label for="type_de_requete">Type of Request:</label>
        <input type="text" name="type_de_requete" id="type_de_requete" required><br>

        <input type="submit" value="Add Request">
    </form>

    <?php if (!empty($requete)): ?>
        <div class="success">Requete added successfully!</div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Your Company | All Rights Reserved</p>
</footer>

</body>
</html>
