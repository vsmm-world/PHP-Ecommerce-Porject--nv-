<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$password = $_POST['password'];
$username = $_POST['username'];
$email = $_POST['email'];

// Prepare and execute SQL statement
$stmt = $conn->prepare("INSERT INTO admin (first_name, last_name, password, username, email) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $first_name, $last_name, $password, $username, $email);

if ($stmt->execute()) {
    echo "Admin registered successfully!";

    // Redirect to the login page
    header("Location: login.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>