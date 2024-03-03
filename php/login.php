<?php
include 'header.php';

// Check if the user is already logged in
$user = getUserData();
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
