<?php
session_start();
include 'includes/../../db.php';

// Handle the "Add to Cart" action
if (isset($_GET['add'])) {
    $product_id = $_GET['add']; // Get the product ID
    $user_id = $_SESSION['user_id']; // Get the user ID
    $quantity = 1; // Default quantity is 1

    // Check if the product already exists in the user's cart
    $sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If the product already exists in the cart, update the quantity
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity; // Increase the quantity
        $update_sql = "UPDATE cart SET quantity = '$new_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $conn->query($update_sql);
    } else {
        // If the product does not exist, insert it into the cart
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
        $conn->query($insert_sql);
    }

    // Redirect to the cart page after adding the item
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Fruit & Veg Delivery</title>
    <link rel="stylesheet" href="./home.css">
</head>
<body>
    <div class="navbar">
        <h2>🍏 Fruit & Veg Delivery</h2>
        <div>
            <span>Welcome, <?php echo $_SESSION['user_name']; ?>!</span>
            <a href="cart.php" class="btn">🛒 Cart</a>
            <a href="logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Fresh Fruits & Vegetables</h1>
        <div class="products">
            <?php
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product-card'>
                        <img src='../images/" . $row['image'] . "' alt='" . $row['name'] . "' class='product-img'>
                        <div class='product-info'>
                            <h2>" . $row['name'] . "</h2>
                            <p>$" . $row['price'] . "</p>
                            <a href='home.php?add=" . $row['id'] . "' class='btn'>Add to Cart</a>
                        </div>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
