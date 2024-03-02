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
// Fetch categories from the database
$categorySql = "SELECT * FROM category";
$categoryResult = $conn->query($categorySql);

// Fetch brands from the database
$brandSql = "SELECT * FROM brand";
$brandResult = $conn->query($brandSql);

// ...




// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_product"])) {
        $id = $_POST["delete_product"];

        // Delete product from the database
        $deleteSql = "DELETE FROM products WHERE id = '$id'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "Product deleted successfully";
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    } elseif (isset($_POST["product_name"]) && isset($_POST["category"]) && isset($_POST["brand"]) && isset($_POST["price"]) && isset($_POST["description"]) && isset($_POST["image_url"])) {
        $product_name = $_POST["product_name"];
        $category = $_POST["category"];
        $brand = $_POST["brand"];
        $price = $_POST["price"];
        $description = $_POST["short_description"];
        $image_url = $_POST["image_url"];

        // Insert new product into the database
        $insertSql = "INSERT INTO products (name, category_id, brand_id, price, description, image_url) VALUES ('$product_name', '$category', '$brand', '$price', '$description', '$image_url')";
        if ($conn->query($insertSql) === TRUE) {
            echo "Product added successfully";
        } else {
            echo "Error adding product: " . $conn->error;
        }
    }
}
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
                echo "<td>" . $row["image_url"] . "</td>";
                echo "<td><form method='POST'><button type='submit' name='delete_product' value='" . $row["id"] . "'>Delete</button></form></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        ?>
    </table>

    <h2>Add Product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="product_name" required><br><br>


        <label for="category">Category:</label>
<select name="category" id="category" required>
    <?php
    if ($categoryResult->num_rows > 0) {
        while ($categoryRow = $categoryResult->fetch_assoc()) {
            echo "<option value='" . $categoryRow["category_id"] . "'>" . $categoryRow["name"] . "</option>";
        }
    }
    ?>
</select><br><br>

        <label for="brand">Brand:</label>
        <select name="brand" id="brand" required>
            <?php
            if ($brandResult->num_rows > 0) {
                while ($brandRow = $brandResult->fetch_assoc()) {
                    echo "<option value='" . $brandRow["brand_id"] . "'>" . $brandRow["name"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br><br>

        <label for="short_description">Description:</label>
        <textarea name="short_description" id="description" required></textarea><br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" id="image_url" required><br><br>

        <input type="submit" value="Add Product">
    </form>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
