<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "cs";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $mobile_no = $_POST["mobile_no"];
    $address = $_POST["address"];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, user_name, password, email, mobile_no, address) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sssssss", $first_name, $last_name, $user_name, $hashed_password, $email, $mobile_no, $address);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Registration successful
            // Redirect to the login page
            header("Location: login.php");
            exit();
        } else {
            // Something went wrong with the SQL execution
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$mysqli->close();
