<?php
// Start the session
session_start();

// Include the database connection file
include 'db_connection.php';

// Check if the database connection is established
if (!isset($conn)) {
    die("Database connection failed.");
}

// Fetch users from the database (for displaying users or other purposes)
$sql = "SELECT first_name, surname, governorate, email, id, created_at FROM users";
$stmt = $conn->prepare($sql);  // Prepare the query
$stmt->execute();             // Execute the query

// Fetch all results as an associative array
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission when method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs (email and password)
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize email and password inputs
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);  // Clean the email
    $password = htmlspecialchars($password);  // Clean the password to prevent XSS

    try {
        // Prepare SQL query to check if the email exists in the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);  // Bind email parameter
        $stmt->execute();  // Execute the query

        // Check if user with this email exists
        if ($stmt->rowCount() > 0) {
            // Fetch the user record
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify the password entered by the user with the hashed password in the database
            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                $_SESSION['id'] = $user['id'];  // Store user ID in session
                $_SESSION['email'] = $user['email'];  // Optionally store the email in session

                // Redirect to user dashboard or any page you want
                header("Location: /userdashboard/index.php");  // Change to your dashboard path
                exit();  // End the script to prevent further processing
            } else {
                // Incorrect password
                echo "Incorrect password!";
            }
        } else {
            // Email not found in the database
            echo "No user found with this email!";
        }
    } catch (PDOException $e) {
        // Handle any query errors
        echo "Error: " . $e->getMessage();
    }
}
?>
