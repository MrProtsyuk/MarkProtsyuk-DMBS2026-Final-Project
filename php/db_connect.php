<?php
$servername = "146.190.39.201";
$port = "33069";
$username = "student_s009";
$password = "bqtdKY2+Z*0Hk(Ptp-a6";
$dbname = "blog_s009";

// Create connection
// Added $port to the constructor to ensure it connects to the correct service
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    // Generic error message to prevent sensitive information disclosure
    die("Database connection failed. Please contact the administrator.");
}
?>
