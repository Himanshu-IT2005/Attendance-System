<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your database password
$dbname = "attendance_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
