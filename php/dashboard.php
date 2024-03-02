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
    $conn = new mysqli('localhost', 'username', 'password', 'cs');
    
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
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Cosmetic Store Dashboard</h1>
    </header> 
    <main>
        <?php if ($loggedInUser !== null): ?>
            <p>Logged in as: <?php echo $loggedInUser['first_name']; ?></p>
            <!-- Display additional user information if needed -->
        <?php else: ?>
            <p>Not logged in</p>
            <!-- Add login/signup options here if needed -->
        <?php endif; ?>
        
        <!-- Display some products -->
        <?php foreach ($products as $product): ?>
            <div>
                <h2><?php echo $product['name']; ?></h2>
                <p><?php echo $product['short_description']; ?></p>
                <p>Price: <?php echo $product['price']; ?></p>
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
