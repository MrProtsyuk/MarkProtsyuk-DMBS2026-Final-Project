<?php
session_start();
include 'db_connect.php';

$username = $_POST['USERNAME'];
$password = $_POST['PASSWORD'];

// Detect potential SQL injection attempts to trigger the "funny" redirect
// $sqli_blacklist = ["' OR", "1=1", "UNION SELECT", "--", ";", "DROP TABLE"];
// foreach ($sqli_blacklist as $pattern) {
//     if (stripos($username, $pattern) !== false) {
//         header("Location: https://youtu.be/Aq5WXmQQooo?si=rexlVkHYz_-5taw2");
//         exit();
//     }
// }

// Use prepared statements to prevent SQL Injection
$stmt = $conn->prepare("SELECT * FROM User_Data WHERE USERNAME=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if ($password === $user['PASSWORD']) {
        $_SESSION['loggedin'] = true;
        header("Location: get_posts.html");
        exit();
    } else {
        echo "Invalid Username or Password";
    }
} else {
    echo "Invalid Username or Password";
}
$stmt->close();
$conn->close();
?>
