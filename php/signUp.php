<?php
session_start(); // Start the session to use session variables for messages
include 'db_connect.php';

// Retrieve and sanitize input from the POST request
// Using isset() to prevent undefined index errors and trim() to remove whitespace
// Checking for both 'username' and 'USERNAME' for flexibility, but it's best to standardize.
$username = isset($_POST['username']) ? trim($_POST['username']) : (isset($_POST['USERNAME']) ? trim($_POST['USERNAME']) : '');
$password = isset($_POST['password']) ? $_POST['password'] : (isset($_POST['PASSWORD']) ? $_POST['PASSWORD'] : '');
$email = isset($_POST['email']) ? trim($_POST['email']) : (isset($_POST['EMAIL']) ? trim($_POST['EMAIL']) : '');

// Hash the password before storing it in the database for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Use prepared statements to prevent SQL Injection
$stmt = $conn->prepare("INSERT INTO User_Data (USERNAME, PASSWORD, EMAIL) VALUES (?, ?, ?)");
// The types should be 'sss' for three strings (username, hashed_password, email)
$stmt->bind_param("sss", $username, $hashed_password, $email);

if ($stmt->execute()) {
    // Set a success message in a session variable to display on the login page
    $_SESSION['message'] = "Account created successfully! Please log in.";
    header("Location: login.html"); // Redirect to login page
    exit(); // Always call exit() after a header redirect
} else {
    // Log the error internally and show a generic message to the user
    // Set an error message in a session variable
    $_SESSION['error'] = "Error: Could not create record. Please try again.";
    header("Location: login.html"); // Redirect back to login or signup page
    exit(); // Always call exit() after a header redirect
}

$stmt->close();
$conn->close();
?>