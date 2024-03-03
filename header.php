<link rel="stylesheet" href="../style.css">
<header>
    <nav>
        <div class="company-name">
            <a href="./">Online Cosmetic Store</a>
        </div>
        <div class="menu">
            <ul>
                <?php
                // User is not logged in, show options for login and register
                echo '<li><a href="./php/login.php">Login</a></li>';
                echo '<li><a href="./php/registration.php">Register</a></li>';
                ?>
            </ul>
        </div>
    </nav>
</header>
