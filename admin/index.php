<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <style>
        .container {
            text-align: center;
            margin-top: 100px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: bold;
        }
        
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 200px;
            padding: 5px;
        }
        
        .form-group input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .register-link {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="POST" action="adminLogin.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
        
        <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
