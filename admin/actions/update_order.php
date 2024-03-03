<?php
// Assuming you have already established a database connection

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_order'])) {
    // Retrieve the form data
    $orderId = $_POST['order_id'];
    $deliveryDate = $_POST['delivery_date'];

    // Perform the database update
    $sql = "UPDATE orders SET delivery_date = '$deliveryDate' WHERE id = '$orderId'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        // Update successful
        echo $deliveryDate;
        echo "Order updated successfully.";
        // header("Location: ../admin.php?page=get_orders");
    } else {
        // Update failed
        echo "Error updating order: " . mysqli_error($connection);
    }
}
?>