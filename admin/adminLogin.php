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
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute SQL statement
$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if ($password == $row['password']) {
        echo "Login successful!";
        // Set session data
        session_start();
        
        // Set cookie data
        $_SESSION['admin'] = $row;
        $adminData = json_encode($row);
        setcookie('admin_data', $adminData, time() + (86400 * 30), '/'); // Cookie expires in 30 days

        // Redirect to the dashboard page
        header("Location: admin.php");
    } else {
        echo "Invalid password!";
    }
} else {
    echo "Invalid username!";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>