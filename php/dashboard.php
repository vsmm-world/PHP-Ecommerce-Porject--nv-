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

// Get the data of the logged in user
$loggedInUser = getUserData();

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

