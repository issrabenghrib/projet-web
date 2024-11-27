<?php
// Paramètres de connexion
$host = "localhost";
$dbname = "mabase"; // Nom de la base de données
$username = "root"; // Par défaut, utilisateur de phpMyAdmin
$password = "";     // Mot de passe (vide par défaut si XAMPP ou WAMP est utilisé)

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configurer PDO pour afficher les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur
    die("Erreur de connexion : " . $e->getMessage());
}
?>
