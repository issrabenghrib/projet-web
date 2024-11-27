<?php
// Include the database connection
include '../../db_connection.php';

// Check if 'id' is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete user query
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect back to the user list page
    header("Location: signuplist.php");
    exit;
} else {
    echo "Invalid request.";
}
