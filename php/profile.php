<?php
// Include the necessary database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cs";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to get user data
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

// Get the user data
$userData = getUserData();

// Check if user data is available
if ($userData) {
    // Display user details
    echo "User ID: " . $userData['id'] . "<br>";
    echo "First Name: " . $userData['first_name'] . "<br>";
    echo "Last Name: " . $userData['last_name'] . "<br>";
    echo "Email: " . $userData['email'] . "<br>";
    
    // Fetch and display user's purchase history from the database
    $userId = $userData['id'];
    $query = "SELECT orders.*, products.name AS product_name FROM orders INNER JOIN products ON orders.product_id = products.id WHERE orders.customer_id = $userId";

    // Execute the query and fetch the results
    $result = mysqli_query($connection, $query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Display the data in cards
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Product Name: ' . $row['product_name'] . '</h5>';
                echo '<p class="card-text">Price: ' . $row['price'] . '</p>';
                // Display other relevant information from the orders table
                echo '</div>';
                echo '</div>';
            }
         
    } else {
        echo 'Error executing query: ' . mysqli_error($connection);
    }
    } else {
        echo "Error executing query: " . mysqli_error($connection);
    }
    
} else {
    echo "User data not found.";
}
?>