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

// Fetch students from the database
$query = "SELECT id, full_name FROM students";
$result = $conn->query($query);

// Close the connection after fetching the data
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance Management</title>
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
            width: 400px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
        }

        h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            color: #0288d1;
        }

        .attendance-form .input-container {
            position: relative;
            margin: 25px 0;
        }

        .attendance-form input,
        .attendance-form select {
            background: none;
            border: none;
            border-bottom: 2px solid #ddd;
            padding: 15px 0;
            width: 100%;
            font-size: 1.2rem;
            color: #333;
            appearance: none;
        }

        .attendance-form input:focus,
        .attendance-form select:focus {
            outline: none;
            border-color: #0288d1;
        }

        .attendance-form label {
            position: absolute;
            top: 15px;
            left: 0;
            pointer-events: none;
            transition: 0.3s ease;
            font-size: 1rem;
            color: #777;
        }

        .attendance-form input:focus ~ label,
        .attendance-form input:not(:placeholder-shown) ~ label,
        .attendance-form select:focus ~ label,
        .attendance-form select:not([value=""]) ~ label {
            top: -20px;
            font-size: 0.85rem;
            color: #0288d1;
        }

        .underline {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: #fbc02d;
            transition: width 0.3s ease;
        }

        .attendance-form input:focus ~ .underline,
        .attendance-form select:focus ~ .underline {
            width: 100%;
        }

        .submit-button {
            margin-top: 25px;
            background-color: #0288d1;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 15px 25px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .submit-button:hover {
            background-color: #fbc02d;
            color: #333;
            transform: translateY(-5px);
        }

        .submit-button:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Attendance Marking</h2><br><br>
        <form class="attendance-form" method="POST" action="attendance.php">
            <div class="input-container">
                <select name="student_id" required>
                    <option value="" disabled selected>Select Student</option>
                    <?php
                        // Fetch students from the database and display them in the dropdown
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['full_name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No students found</option>";
                        }
                    ?>
                </select>
                <label for="student_id">Student</label>
                <span class="underline"></span>
            </div>

            <div class="input-container">
                <input type="date" name="date" required>
                <label for="date">Date</label>
                <span class="underline"></span>
            </div>

            <div class="input-container">
                <select name="attendance_status" required>
                    <option value="" disabled selected>Select Attendance</option>
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                </select>
                <label for="attendance_status">Attendance Status</label>
                <span class="underline"></span>
            </div>

            <button type="submit" class="submit-button">Submit Attendance</button>
        </form>
    </div>
</body>
</html>