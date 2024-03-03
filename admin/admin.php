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
// Fetch products from the database with brand and category names
$sql = "SELECT products.*, brand.name AS brand_name, category.name AS category_name 
    FROM products 
    INNER JOIN brand ON products.brand_id = brand.id 
    INNER JOIN category ON products.category_id = category.id";
$result = $conn->query($sql);

// Fetch categories from the database
$categorySql = "SELECT * FROM category";
$categoryResult = $conn->query($categorySql);

// Fetch brands from the database
$brandSql = "SELECT * FROM brand";
$brandResult = $conn->query($brandSql);

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
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["category_name"] . "</td>";
                echo "<td>" . $row["brand_name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["short_description"] . "</td>";
                echo "<td>
                        <form method='POST' action='./actions/delete_prod.php'>
                            <input type='hidden' name='product_id' value='" . $row["id"] . "'>
                            <button type='submit' name='delete_product'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";

                // Separate form for updating data
                echo "<td colspan='7'>";
                echo "<form method='POST' action='./actions/update_prod.php'>";
                echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
                echo "<label for='update_price'>Update Price:</label>";
                echo "<input type='text' name='update_price' id='update_price' value='" . $row["price"] . "' required>";
                echo "<input type='submit' value='Submit'>";
                echo "</form>";
                echo "</td>";
            }
        } else {
            echo "<tr><td colspan='7'>No products found</td></tr>";
        }
        ?>
    </table>

    <h2>Add Product</h2>
    <form action="./actions/add_prod.php" method="POST">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br><br>

        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            if ($categoryResult->num_rows > 0) {
                while ($categoryRow = $categoryResult->fetch_assoc()) {
                    echo "<option value='" . $categoryRow["id"] . "'>" . $categoryRow["name"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="brand_id">Brand:</label>
        <select name="brand_id" id="brand_id" required>
            <?php
            if ($brandResult->num_rows > 0) {
                while ($brandRow = $brandResult->fetch_assoc()) {
                    echo "<option value='" . $brandRow["id"] . "'>" . $brandRow["name"] . "</option>";
                }
            }
            ?>
        </select><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required><br><br>

        <label for="short_description">Description:</label>
        <textarea name="short_description" id="short_description" required></textarea><br><br>

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
