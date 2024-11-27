<?php
// Configuration de la base de données
$host = "localhost";
$dbname = "mabase";
$username = "root";
$password = "";

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer et valider les données du formulaire
    $first_name = !empty($_POST['first_name']) ? htmlspecialchars(trim($_POST['first_name'])) : null;
    $surname = !empty($_POST['surname']) ? htmlspecialchars(trim($_POST['surname'])) : null;
    $governorate = !empty($_POST['governorate']) ? htmlspecialchars(trim($_POST['governorate'])) : null;
    $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $password = !empty($_POST['password']) ? trim($_POST['password']) : null;

    // Vérification des champs obligatoires
    if ($first_name && $surname && $governorate && $email && $password) {
        // Hachage sécurisé du mot de passe
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Préparer la requête SQL
        $sql = "INSERT INTO users (first_name, surname, governorate, email, password) 
                VALUES (:first_name, :surname, :governorate, :email, :password)";
        $stmt = $pdo->prepare($sql);

        try {
            // Exécuter la requête avec les paramètres sécurisés
            $stmt->execute([
                ':first_name' => $first_name,
                ':surname' => $surname,
                ':governorate' => $governorate,
                ':email' => $email,
                ':password' => $hashed_password,
            ]);
            
            // Rediriger vers la page d'accueil après une inscription réussie
            header("Location: /userdashboard/signin/signin.html");
            exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
        } catch (PDOException $e) {
            // Gérer les erreurs SQL
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir tous les champs obligatoires.";
    }
} else {
    echo "Requête invalide.";
}
?>
