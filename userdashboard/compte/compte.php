<?php
// Start the session
session_start();

// Include the database connection file (ensure the path is correct)
include '../../db_connection.php';  // Adjust the path based on your project directory structure

// Ensure the database connection is established
if (!isset($conn)) {
    die("Database connection failed.");
}

// Collect user input from the form when method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $governorate = $_POST['governorate'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    
    // Assuming user ID is hardcoded for testing (remove once login is implemented)
    $user_id = 1;  // For testing purposes, use a static user ID

    // Check if the user uploaded a new profile photo
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        // Handle profile photo upload
        $photo_name = $_FILES['profile_photo']['name'];
        $photo_tmp = $_FILES['profile_photo']['tmp_name'];
        $photo_ext = pathinfo($photo_name, PATHINFO_EXTENSION);

        // Validate file type
        if (in_array(strtolower($photo_ext), ['jpg', 'jpeg', 'png'])) {
            $new_photo_name = "profile_" . $user_id . "." . $photo_ext;
            $photo_path = "uploads/" . $new_photo_name;

            // Ensure uploads directory exists
            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);  // Create if not exists
            }

            // Move the uploaded file to the uploads folder
            if (!move_uploaded_file($photo_tmp, $photo_path)) {
                echo "Error: Could not upload file.";
                exit();
            }
        } else {
            echo "Invalid file type. Only jpg, jpeg, and png are allowed.";
            exit();
        }
    } else {
        // If no photo uploaded, use default photo
        $photo_path = "uploads/default-photo.jpg";
    }

    // Hash the password if it's not empty
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = null;  // If no password is entered, keep it null
    }

    // Prepare the SQL query to update user data
    $update_query = "UPDATE users SET first_name = :first_name, surname = :surname, governorate = :governorate, 
                    email = :email, phone = :phone, password = :password, 
                    profile_photo = :profile_photo WHERE id = :user_id";

    try {
        // Prepare and execute the query with bind parameters to prevent SQL injection
        $stmt = $conn->prepare($update_query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':governorate', $governorate);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':profile_photo', $photo_path);
        $stmt->bindParam(':user_id', $user_id);

        // Execute the update query
        if ($stmt->execute()) {
            echo "Profile updated successfully!";
        } else {
            echo "Error: Could not update profile.";
        }
    } catch (PDOException $e) {
        // Handle any query execution errors
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection (optional, as PDO is closed automatically when script ends)
    $conn = null;
}
?>
