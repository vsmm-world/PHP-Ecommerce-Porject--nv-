<?php

// Include your database connection file here
// Example: include 'db_connection.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "cs";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate username and password (you should add more validation and sanitization)
    // This is just a basic example
    $sql = "SELECT * FROM customer WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Login successful
            // Store user in session
            session_start();
            $_SESSION['user'] = $row;

            // Store user data in a cookie
            $userData = json_encode($row);
            setcookie('user_data', $userData, time() + (86400 * 30), '/'); // Cookie expires in 30 days

            // Redirect to a logged-in page
            header("Location: ../php/dashboard.php");
            exit();
        } else {
            // Login failed
            echo "Invalid username or password";
        }
    } else {
        // Login failed
        echo "Invalid username or password";
    }
}

$conn->close();
?>
