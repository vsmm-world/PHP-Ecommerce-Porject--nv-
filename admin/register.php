<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];

    if (!($password === $confirm_password)) {
        $error_message = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Registration</title>
    <style>
        .container {
            width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 5px;
        }

        .error-message {
            color: red;
        }

        /* Added CSS for the button */
        .form-group input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Registration</h2>
        <?php if (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <form method="POST" action="adminReg.php">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>