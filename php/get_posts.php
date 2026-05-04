<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit();
}

include 'db_connect.php';

$sql = "SELECT * FROM Post_Data";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Use htmlspecialchars to prevent XSS
        echo "id: " . htmlspecialchars($row["PostID"]) . 
             " - Title: " . htmlspecialchars($row["Title"]) . 
             " " . htmlspecialchars($row["Content"]) . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
