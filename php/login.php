<?php
session_start();
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Detect potential SQL injection attempts to trigger the "funny" redirect
$sqli_blacklist = ["' OR", "1=1", "UNION SELECT", "--", ";", "DROP TABLE"];
foreach ($sqli_blacklist as $pattern) {
    if (stripos($username, $pattern) !== false || stripos($password, $pattern) !== false) {
        header("Location: https://youtu.be/Aq5WXmQQooo?si=rexlVkHYz_-5taw2");
        exit();
    }
}

// Use prepared statements to prevent SQL Injection
$stmt = $conn->prepare("SELECT * FROM Users WHERE Username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if ($password === $user['Password']) {
        $_SESSION['loggedin'] = true;
        header("Location: get_posts.php");
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
