<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = null;
// If a student ID is provided, fetch attendance data
if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $query = "SELECT * FROM attendance WHERE student_id = '$student_id'";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #0288d1, #fbc02d);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 50px;
            width: 600px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
        }

        h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            color: #0288d1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #0288d1;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            font-size: 1rem;
            width: 80%;
            border: 2px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .search-container button {
            padding: 10px 20px;
            background-color: #0288d1;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .search-container button:hover {
            background-color: #fbc02d;
        }

        .back-button {
            margin-top: 20px; 
            padding: 10px 20px;
            background-color: #0288d1; 
            color: #fff; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 1rem; 
            text-align: center; 
        } 

        .back-button:hover { 
            background-color: #fbc02d; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>View Attendance</h2>

        <div class="search-container">
            <input type="text" id="search-student-id" placeholder="Search by Student ID">
            <button onclick="searchAttendance()">Search</button>
        </div>

        <?php if ($result): ?>
            <table id="attendance-table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Date</th>
                        <th>Attendance Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data for each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['student_id'] . "</td>
                                    <td>" . $row['date'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No attendance records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <button class="back-button" onclick="window.history.back()">Go Back</button>
    </div>

    <script>
        function searchAttendance() {
            const studentId = document.getElementById("search-student-id").value;
            window.location.href = "view_attendance.php?student_id=" + studentId;
        }
    </script>
</body>
</html>
