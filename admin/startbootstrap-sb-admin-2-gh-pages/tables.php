<?php
// Database configuration
$host = "localhost";
$dbname = "mabase";  // Your database name
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (empty)

// Create a PDO instance to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


$sql = "SELECT first_name, surname, governorate, email, created_at FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$users) {
    echo "<tr><td colspan='5'>No data available</td></tr>";
} else {
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($user['surname']) . "</td>";
        echo "<td>" . htmlspecialchars($user['governorate']) . "</td>";
        echo "<td>" . htmlspecialchars($user['email']) . "</td>";
        echo "<td>" . date('Y-m-d H:i:s', strtotime($user['created_at'])) . "</td>";
        echo "</tr>";
    }
}

// Debug: Print the SQL query
echo "<p>SQL Query: " . $sql . "</p>";

// Debug: Print the fetched data
print_r($users);
?>