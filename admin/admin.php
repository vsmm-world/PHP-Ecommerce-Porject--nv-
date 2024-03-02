<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Admin Page</h1>

    <table>
        <tr>
            <th>Product Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["brand"] . "</td>";
                echo "<td><input type='text' value='" . $row["price"] . "'></td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td><a href='delete_product.php?id=" . $row["id"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        ?>
    </table>

    <h2>Add Product</h2>
    <form action="add_product.php" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="category1">Category 1</option>
            <option value="category2">Category 2</option>
            <option value="category3">Category 3</option>
        </select><br><br>

        <label for="brand">Brand:</label>
        <select name="brand" id="brand" required>
            <option value="brand1">Brand 1</option>
            <option value="brand2">Brand 2</option>
            <option value="brand3">Brand 3</option>
        </select><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" id="image_url" required><br><br>

        <input type="submit" value="Add Product">
    </form>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>