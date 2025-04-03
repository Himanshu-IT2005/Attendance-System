<?php
// Database connection settings
$servername = "localhost";
$username = "root";   // Use your database username
$password = "";       // Use your database password
$dbname = "attendance_system"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to insert attendance
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $attendance_status = $_POST['attendance_status'];

    // Insert attendance record
    $insert_query = "INSERT INTO attendance (student_id, date, status) VALUES ('$student_id', '$date', '$attendance_status')";
    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Attendance added successfully!');</script>";
        echo "<script>window.location.href='after_login.html';</script>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

// Close connection
$conn->close();
?>