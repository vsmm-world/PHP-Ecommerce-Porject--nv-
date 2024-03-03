<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product ID from the form
    $product_id = $_POST["product_id"];

    // Get the updated price from the form
    $update_price = $_POST["update_price"];

    // TODO: Validate and sanitize the input values

    // Connect to the database
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "cs";
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the update query
    $sql = "UPDATE products SET price = '$update_price' WHERE id = '$product_id'";

    // Execute the update query
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php");

    } else {
        echo "Error updating product: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>