<?php
// Establish a database connection
$connection = mysqli_connect('localhost', 'root', '', 'cs');
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the customer ID and product ID from the form
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];

    // Fetch the product details from the database
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($connection, $query);
    $product = mysqli_fetch_assoc($result);

    // Check if the customer is sure to purchase the product
    $customer_confirmation = false; // Add this line

    // Display the product details to the customer
    echo "<h2>Product Details</h2>";
    echo "<p>Name: " . $product['name'] . "</p>";
    echo "<p>Description: " . $product['short_description'] . "</p>";
    echo "<p>Price: $" . $product['price'] . "</p>";

    // Ask the customer if they are sure to purchase the product
    echo "<h3>Confirmation</h3>";
    echo "<p>Payment Mode: Cash on Delivery</p>";
    echo "<p>Are you sure you want to purchase this product?</p>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='customer_id' value='$customer_id'>";
    echo "<input type='hidden' name='product_id' value='$product_id'>";
    echo "<input type='submit' onclick=\"document.getElementsByName('customer_confirmation')[0].value = 'true'\" name='confirm_purchase' value='Yes'>";
    echo "<input type='submit' onclick=\"window.location.href = 'dashboard.php'\" name='cancel_purchase' value='No'>";
    echo "<input type='hidden' name='customer_confirmation' value='$customer_confirmation'>";
    echo "</form>";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_confirmation'])) {
        $customer_confirmation = $_POST['customer_confirmation'];

        if ($customer_confirmation === 'true') {
            // Calculate the price of the product
            $price = $product['price'];

            // // Get the current date for delivery date
            $delivery_date = date('Y-m-d');

            // Add 5 days to the delivery date
            // $delivery_date = date('Y-m-d', strtotime($delivery_date . ' + 5 days'));

            // Insert the new order into the database
            $insert_query = "INSERT INTO orders (customer_id, price, product_id, delivery_date) 
                             VALUES ('$customer_id', '$price', '$product_id', '$delivery_date')";

            // Check if the customer exists
            $customer_query = "SELECT * FROM customer WHERE id = '$customer_id'";
            $customer_result = mysqli_query($connection, $customer_query);
            $customer_exists = mysqli_num_rows($customer_result) > 0;

            if ($customer_exists) {
                mysqli_query($connection, $insert_query);
                echo "Order created successfully!";
                // flush();
                sleep(3);
                header("Location: ../php/dashboard.php");
                exit();

            exit();

            } else {
                echo "Invalid customer ID!";
            exit();

            }

            // Redirect the user to a success page or display a success message
            // header("Location: success.php");
            // exit();
        } else {
            // Redirect the user to a confirmation page or display a confirmation message
            // header("Location: confirmation.php");
            // exit();
            echo "Tumhare pass paise nahi hai , chale jao yaha se ";
        }
    }
}
?>