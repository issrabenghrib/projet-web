<?php
// Include the database connection
include '../../db_connection.php';

// Check if 'id' is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit;
    }
}

// Update user data on form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $governorate = $_POST['governorate'];
    $email = $_POST['email'];

    // Update SQL query
    $update_sql = "UPDATE users SET first_name = :first_name, surname = :surname, governorate = :governorate, email = :email WHERE id = :id";
    $stmt = $pdo->prepare($update_sql);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':surname', $surname);
    $stmt->bindParam(':governorate', $governorate);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect back to the user table
    header("Location: signuplist.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/admindashboard/ss.css" rel="stylesheet">

    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        <br>

        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname" value="<?php echo htmlspecialchars($user['surname']); ?>" required>
        <br>

        <label for="governorate">Governorate:</label>
        <input type="text" name="governorate" id="governorate" value="<?php echo htmlspecialchars($user['governorate']); ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
