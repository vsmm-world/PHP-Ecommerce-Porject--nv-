<?php

// Function to retrieve user data from the cookie
function getUserData() {
    // Check if the 'user_data' cookie is set
    if (isset($_COOKIE['user_data'])) {
        // Retrieve the user data from the cookie
        $userData = $_COOKIE['user_data'];
        
        // Parse the user data (assuming it's in JSON format)
        $user = json_decode($userData, true);
        
        // Return the user data
        return $user;
    } else {
        // Return null if the user data is not found
        return null;
    }
}

// Function to retrieve products from the database
function getProducts() {
    // Connect to the database
    $conn = new mysqli('localhost', 'root', '', 'cs');
    
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Query to retrieve products
    $sql = "SELECT * FROM products";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if any products are found
    if ($result->num_rows > 0) {
        // Fetch the products as an associative array
        $products = $result->fetch_all(MYSQLI_ASSOC);
        
        // Close the database connection
        $conn->close();
        
        // Return the products
        return $products;
    } else {
        // Close the database connection
        $conn->close();
        
        // Return an empty array if no products are found
        return [];
    }
}

// Get the data of the logged in user
$loggedInUser = getUserData();

// Get the products
$products = getProducts();

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosmetic Store Dashboard</title>
    <!-- Include any necessary CSS or JavaScript files here -->
    <style>
        /* Add your CSS styles here */
        .product-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .product-card h2 {
            margin-top: 0;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
        }
        .product-card p {
            margin-bottom: 5px;
        }
        .buy-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
        }
    </style>
    <link rel="stylesheet" href="userSide.css">
</head>
<body>
    <header>
        <h1 class="dashboard-title">Welcome to the Cosmetic Store Dashboard</h1>
    </header> 
    <main>
        <?php if ($loggedInUser !== null): ?>
            <!-- <p class="user-info">Logged in as: <?php echo $loggedInUser['first_name']; ?></p> -->
            <!-- Display additional user information if needed -->
        <?php else: ?>
            <p class="user-info">Not logged in</p>
            <?php if ($loggedInUser === null): ?>
                <?php header("Location: login.php"); ?>
            <?php endif; ?>
        <?php endif; ?>
        
        <!-- Display some products -->
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h2 class="product-name"><?php echo $product['name']; ?></h2>
                <img class="product-image" src="<?php echo $product['image_url']; ?>" alt="Product Image">
                <p class="product-description"><?php echo $product['short_description']; ?></p>
                <p class="product-price">Price: <?php echo $product['price']; ?></p>
                <?php if ($loggedInUser !== null): ?>
                    <form action="../php_process/buy.php" method="post">
                        <input type="hidden" name="customer_id" value="<?php echo $loggedInUser['id']; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="submit" class="buy-button" value="Buy">
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        
        <!-- Add your dashboard content here -->
    </main>
    <footer>
        <!-- Add footer content here -->
    </footer>
    <!-- Include any necessary JavaScript files here -->
    <script>
        // Add your JavaScript code here
    </script>
</body>
</html>
<?php include 'footer.php'; ?>
