<?php
$servername = "146.190.39.201";
$port = "33069";
$username = "student_s009";
$password = "bqtdKY2+Z*0Hk(Ptp-a6";
$dbname = "blog_s009";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
