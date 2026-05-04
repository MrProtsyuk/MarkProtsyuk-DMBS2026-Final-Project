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
        echo "<div class='post-container'>";
        echo "<h3>" . htmlspecialchars($row["Title"]) . "</h3>";
        echo "<p><strong>Post ID:</strong> " . htmlspecialchars($row["PostID"]) . "</p>";
        echo "<p>" . htmlspecialchars($row["Content"]) . "</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
