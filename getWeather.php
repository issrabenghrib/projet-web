<?php
// Database configuration
$host = 'localhost';
$dbname = 'meteo';
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error and return a JSON response
    error_log("Database connection failed: " . $e->getMessage());
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit; // Stop further execution
}

// Get the selected date and weather detail from the request
$selectedDate = $_GET['date'];
$weatherDetail = $_GET['detail'];

// Prepare the SQL query
$stmt = $pdo->prepare("SELECT $weatherDetail FROM prediction WHERE date = :date");
$stmt->bindParam(':date', $selectedDate);
$stmt->execute();

// Fetch the result
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['error' => 'No data found for the selected date.']);
}
?>