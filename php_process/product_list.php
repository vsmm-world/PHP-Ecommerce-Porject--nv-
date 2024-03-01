<?php 
// Assuming you have a database connection established

// Function to get product list by brand
function getProductListByBrand($brandId) {
    global $connection; // Assuming $connection is your database connection

    // Perform SQL query to fetch products based on brand
    $query = "SELECT * FROM products WHERE brand_id = $brandId";
    $result = mysqli_query($connection, $query);

    // Check if query was successful
    if (!$result) {
        die("Database query failed.");
    }

    // Display products with images, product ID, and other details
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>Product ID: " . $row['product_id'] . "</h3>";
        echo "<h4>" . $row['product_name'] . "</h4>";
        echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Price: $" . $row['price'] . "</p>";
        // You can add more details as needed
        echo "</div>";
    }

    // Release the result set
    mysqli_free_result($result);
}

// Get brand ID from the URL parameter
$brandId = $_GET['brand_id'];

// Display product list for the specified brand
getProductListByBrand($brandId);

// Close the database connection
mysqli_close($connection);
?>
