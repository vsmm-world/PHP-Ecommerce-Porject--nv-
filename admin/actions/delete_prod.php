<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_product'])) {
    // Get the product ID from the form
    $product_id = $_POST['product_id'];


    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cs";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php");
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>