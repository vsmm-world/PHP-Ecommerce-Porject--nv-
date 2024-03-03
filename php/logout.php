
<?php
// Start session
session_start();

// Clear session data
$_SESSION = array();
session_destroy();

// Clear cookies
setcookie('user_data', '', time() - 3600, '/');

// Redirect to login page
header("Location: ../php/login.php");
exit();
?>