<?php
include 'header.php';

function getNData() {
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
$user = getNData();
if ($user !== null) {
    // Redirect the user to the dashboard
    header('Location: dashboard.php');
    exit;
}
?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Login</h2>
    <form action="../php_process/process_login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
    </form>
</div>

<?php include 'footer.php'; ?>
