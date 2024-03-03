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

// Fetch orders from the database
$orderSql = "SELECT orders.*, products.name AS product_name 
    FROM orders 
    INNER JOIN products ON orders.product_id = products.id";
$orderResult = $conn->query($orderSql);

// Fetch categories from the database
$categorySql = "SELECT * FROM category";
$categoryResult = $conn->query($categorySql);

// Display categories in a table
// Fetch brands from the database
$brandSql = "SELECT * FROM brand";
$brandResult = $conn->query($brandSql);

// Display brands in a table
// Fetch customers from the database
$customerSql = "SELECT * FROM customer";
$customerResult = $conn->query($customerSql);

// Display customers in a table




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
        .navbar {
            background-color: #f1f1f1;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: grey;
        }
        .navbar a.active {
            background-color: #4CAF50;
            color: lime;
        }
    </style>
    <link rel="stylesheet" href="adminSide.css">
</head>
<body>
    <div class="navbar">
        <a class="<?php echo ($page === 'home') ? 'active' : ''; ?>" href="?page=home">Home</a>
        <a class="<?php echo ($page === 'add_product') ? 'active' : ''; ?>" href="?page=add_product">Add Product</a>
        <a class="<?php echo ($page === 'get_products') ? 'active' : ''; ?>" href="?page=get_products">Get Products</a>
        <a class="<?php echo ($page === 'get_customers') ? 'active' : ''; ?>" href="?page=get_customers">Get Customers</a>
        <a class="<?php echo ($page === 'get_brands') ? 'active' : ''; ?>" href="?page=get_brands">Get Brands</a>
        <a class="<?php echo ($page === 'get_categories') ? 'active' : ''; ?>" href="?page=get_categories">Get Categories</a>
        <a class="<?php echo ($page === 'get_orders') ? 'active' : ''; ?>" href="?page=get_orders">Get Orders</a>
    </div>

    <h1 class="admin-title">Admin Page</h1>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'home':
                echo "<h2 class='page-title'>Welcome to the Admin Page</h2>";
                echo "<p>This is the home page of the admin panel. You can use the navigation bar above to access different functionalities.</p>";
                break;
            case 'add_product':
                echo "<h2 class='page-title'>Add Product</h2>";
                echo "<form action='./actions/add_prod.php' method='POST'>";
                echo "<label for='product_name'>Product Name:</label>";
                echo "<input type='text' name='product_name' id='product_name' required><br><br>";

                echo "<label for='category_id'>Category:</label>";
                echo "<select name='category_id' id='category_id' required>";
                if ($categoryResult->num_rows > 0) {
                    while ($categoryRow = $categoryResult->fetch_assoc()) {
                        echo "<option value='" . $categoryRow["id"] . "'>" . $categoryRow["name"] . "</option>";
                    }
                }
                echo "</select><br><br>";

                echo "<label for='brand_id'>Brand:</label>";
                echo "<select name='brand_id' id='brand_id' required>";
                if ($brandResult->num_rows > 0) {
                    while ($brandRow = $brandResult->fetch_assoc()) {
                        echo "<option value='" . $brandRow["id"] . "'>" . $brandRow["name"] . "</option>";
                    }
                }
                echo "</select><br><br>";

                echo "<label for='price'>Price:</label>";
                echo "<input type='text' name='price' id='price' required><br><br>";

                echo "<label for='short_description'>Description:</label>";
                echo "<textarea name='short_description' id='short_description' required></textarea><br><br>";

                echo "<label for='image_url'>Image URL:</label>";
                echo "<input type='text' name='image_url' id='image_url' required><br><br>";

                echo "<input type='submit' value='Add Product'>";
                echo "</form>";
                break;
            case 'get_products':
                echo "<h2 class='page-title'>Get Products</h2>";
                echo "<table class='product-table'>";
                echo "<tr>";
                echo "<th>Product Name</th>";
                echo "<th>Category</th>";
                echo "<th>Brand</th>";
                echo "<th>Price</th>";
                echo "<th>Description</th>";
                echo "<th>Action</th>";
                echo "</tr>";
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
                                    <button type='submit' name='delete_product' class='delete-button'>Delete</button>
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
                echo "</table>";
                break;
            case 'get_customers':
                echo "<h2 class='page-title'>Get Customers</h2>";
                if ($customerResult->num_rows > 0) {
                    echo "<table class='customer-table'>";
                    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>User Name</th><th>Email</th><th>Mobile No</th><th>Address</th></tr>";
                    while ($row = $customerResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["user_name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["mobile_no"] . "</td>";
                        echo "<td>" . $row["address"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No customers found.";
                }
                break;
            case 'get_brands':
                echo "<h2 class='page-title'>Get Brands</h2>";
                if ($brandResult->num_rows > 0) {
                    echo "<h2>Brands</h2>";
                    echo "<table class='brand-table'>";
                    echo "<tr><th>ID</th><th>Name</th></tr>";
                    while ($row = $brandResult->fetch_assoc()) {
                        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No brands found.";
                }
                break;
            case 'get_categories':
                echo "<h2 class='page-title'>Get Categories</h2>";
                if ($categoryResult->num_rows > 0) {
                    echo "<table class='category-table'>";
                    echo "<tr><th>ID</th><th>Name</th></tr>";
                    while ($row = $categoryResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No categories found.";
                }
                break;
            case 'get_orders':
                echo "<h2 class='page-title'>Get Orders</h2>";
                if ($orderResult->num_rows > 0) {
                    echo "<h2>Get Orders</h2>";
                    echo "<table class='order-table'>";
                    echo "<tr>";
                    echo "<th>Order ID</th>";
                    echo "<th>Product Name</th>";
                    echo "<th>Price</th>";
                    echo "<th>Delivery Date</th>";
                    echo "</tr>";
                    while ($orderRow = $orderResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $orderRow["id"] . "</td>";
                        echo "<td>" . $orderRow["product_name"] . "</td>";
                        echo "<td>" . $orderRow["price"] . "</td>";
                        echo "<td>
                                <form method='POST' action='./actions/update_order.php'>
                                    <input type='hidden' name='order_id' value='" . $orderRow["id"] . "'>
                                    <input type='date' name='delivery_date' value='" . $orderRow["delivery_date"] . "'>
                                    <button type='submit' name='update_order' class='update-button'>Update</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<h2>No orders found</h2>";
                }
                break;
            default:
                echo "<h2 class='page-title'>Invalid Page</h2>";
                break;
        }
    } else {
        echo "<h2 class='page-title'>Welcome to the Admin Page</h2>";
    }
    ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
