<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $product_name = $_POST["product_name"];
    $category_id = $_POST["category_id"];
    $brand_id = $_POST["brand_id"];
    $price = $_POST["price"];
    $short_description = $_POST["short_description"];
    $image_url = $_POST["image_url"];

    // TODO: Validate and sanitize the form data
    $product_name = htmlspecialchars($product_name);
    $category_id = intval($category_id);
    $brand_id = intval($brand_id);
    $price = floatval($price);
    $short_description = htmlspecialchars($short_description);
    $image_url = htmlspecialchars($image_url);

    // TODO: Connect to the database and insert the product
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cs";

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the category_id exists in the categories table
    $categoryExists = false;
    $categoryQuery = "SELECT * FROM category WHERE id = $category_id";
    $categoryResult = $conn->query($categoryQuery);
    if ($categoryResult->num_rows > 0) {
        $categoryExists = true;
    }

    // Check if the brand_id exists in the brands table
    $brandExists = false;
    $brandQuery = "SELECT * FROM brand WHERE id = $brand_id";
    $brandResult = $conn->query($brandQuery);
    if ($brandResult->num_rows > 0) {
        $brandExists = true;
    }

    if ($categoryExists && $brandExists) {
        // Prepare the SQL statement
        $sql = "INSERT INTO products (name, category_id, brand_id, price, short_description, image_url)
                VALUES ('$product_name', '$category_id', '$brand_id', '$price', '$short_description', '$image_url')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to admin.php after successful product addition
            header("Location: ../admin.php");
            exit;
        } else {
            echo "Error adding product: " . $conn->error;
        }
    } else {
        echo "Invalid category or brand.";
    }

    // Close the database connection
    $conn->close();

    // TODO: Handle success or error messages
}
?>