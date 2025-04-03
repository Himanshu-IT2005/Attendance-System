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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    // Validate the data
    if (empty($full_name) || empty($email)) {
        echo "All fields are required!";
    } else {
        // Prepare the SQL query to insert student details
        $sql = "INSERT INTO students (full_name, email)
                VALUES ('$full_name', '$email')";

        // Execute the query and check if it was successful
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('New student has been added successfully.');</script>";
            echo "<script>window.location.href='after_login.html';</script>";
            // echo "New student has been added successfully.";
            // header('Location: after_login.html');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>