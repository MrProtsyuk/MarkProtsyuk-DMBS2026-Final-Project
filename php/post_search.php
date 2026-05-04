<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit();
}

include 'db_connect.php';

function searchPosts($keyword) {
    global $conn;
    
    // Detect potential SQL injection attempts to trigger the "funny" redirect
    $sqli_blacklist = ["' OR", "1=1", "UNION SELECT", "--", ";", "DROP TABLE"];
    foreach ($sqli_blacklist as $pattern) {
        if (stripos($keyword, $pattern) !== false) {
            header("Location: https://youtu.be/Aq5WXmQQooo?si=rexlVkHYz_-5taw2");
            exit();
        }
    }

    // Use prepared statements to prevent SQL Injection
    $stmt = $conn->prepare("SELECT PostID, Title, Content FROM Post_Data WHERE Title LIKE ? OR Content LIKE ?");
    $searchTerm = "%" . $keyword . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display all posts containing the keyword
        while($row = $result->fetch_assoc()) {
            // Use htmlspecialchars to prevent XSS
            echo "PostID: " . htmlspecialchars($row["PostID"]) . 
                 " - Title: " . htmlspecialchars($row["Title"]) . 
                 " - Content: " . htmlspecialchars($row["Content"]) . "<br>";
        }
    } else {
        echo "No results found";
    }
    $stmt->close();
}

// Example usage
searchPosts("example_keyword");

$conn->close();
?>
