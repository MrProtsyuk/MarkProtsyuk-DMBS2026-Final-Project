<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit();
}

include 'db_connect.php';

$title = $_POST['title'];
$content = $_POST['content'];
$userid = $_POST['userid']; // Assuming user id is known
$categoryid = $_POST['categoryid']; // Assuming category id is known

// Use prepared statements to prevent SQL Injection
$stmt = $conn->prepare("INSERT INTO BlogPosts (UserID, Title, Content, CategoryID) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $userid, $title, $content, $categoryid);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    // Log the error internally and show a generic message to the user
    echo "Error: Could not create record.";
}

$stmt->close();
$conn->close();
?>
