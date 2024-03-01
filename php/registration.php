<?php include './php/header.php'; ?>
<link rel="stylesheet" href="../style.css">
<div class="container">
    <h2>Register</h2>
    <form action="../php_process/process_registration.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br><br>
        <label for="user_name">Username:</label>
        <input type="text" id="username" name="user_name" required>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="mobile_no">Phone Number:</label>
        <input type="text" id="phone_no" name="mobile_no" required>
        <br><br>
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        <br><br>
        <button type="submit">Register</button>
    </form>
</div>

<?php include 'footer.php'; ?>
