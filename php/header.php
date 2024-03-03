<link rel="stylesheet" href="../style.css">
<header>
    <nav>
        <div class="company-name">
            <a href="./">Online Cosmetic Store</a>
        </div>
        <div class="menu">
            <ul>
                <?php
                function getUData() {
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
                $user = getUData();
                if ($user) {
                    // User is logged in, show option to go to dashboard
                    echo '<li><a href="./dashboard.php">Dashboard</a></li>';
                    echo '<li><a href="./profile.php">' . $user['first_name'] . ' ' . $user['last_name'] . '</a></li>';
                    echo '<li><a href="./logout.php">Logout</a></li>';
                } else {
                    // User is not logged in, show options for login and register
                    echo '<li><a href="./login.php">Login</a></li>';
                    echo '<li><a href="./registration.php">Register</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
