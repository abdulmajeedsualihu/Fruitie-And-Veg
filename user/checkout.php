<?php
session_start();
include 'includes/../../db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$sql = "SELECT c.product_id, p.name, p.price, p.image, c.quantity 
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = '$user_id'";
$result = $conn->query($sql);

$cart_items = [];
$total_price = 0;

while ($row = $result->fetch_assoc()) {
    $row['subtotal'] = $row['price'] * $row['quantity']; // Calculate subtotal for each item
    $cart_items[] = $row;
    $total_price += $row['subtotal']; // Add the subtotal to total price
}

// Handle order submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $conn->real_escape_string($_POST['address']);
    $payment_method = $conn->real_escape_string($_POST['payment_method']);

    if (empty($cart_items)) {
        echo "<script>alert('Your cart is empty!'); window.location='home.php';</script>";
        exit();
    }

    $order_number = 'ORD-' . strtoupper(uniqid());  // Example order number
    $created_at = date('Y-m-d H:i:s');  // Current timestamp
    $expected_delivery = date('Y-m-d', strtotime("+7 days"));  // Example expected delivery date, 7 days from now

$sql = "INSERT INTO orders (user_id, total_price, address, payment_method, status, order_number, created_at, expected_delivery) 
        VALUES ('$user_id', '$total_price', '$address', '$payment_method', 'Pending', '$order_number', '$created_at', '$expected_delivery')";

    if ($conn->query($sql)) {
        $order_id = $conn->insert_id;

        // Insert ordered items
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $conn->query("INSERT INTO order_items (order_id, product_id, quantity) 
                          VALUES ('$order_id', '$product_id', '$quantity')");
        }

        // Clear the cart
        $conn->query("DELETE FROM cart WHERE user_id = '$user_id'");

        echo "<script>alert('Order placed successfully!'); window.location='tracker.php';</script>";
        exit();
    } else {
        echo "<script>alert('Order failed. Please try again!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="./checkout.css">
</head>
<body>
    <?php include 'includes/../header.php'; ?>

    <h2>Checkout</h2>
    
    <div class="checkout-container">
        <h3>Order Summary</h3>
        <ul>
            <?php foreach ($cart_items as $item) : ?>
                <li>
                    <img src="./Images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" width="50">
                    <?php echo $item['name']; ?> - $<?php echo number_format($item['subtotal'], 2); ?> x <?php echo $item['quantity']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Total Price: $<?php echo number_format($total_price, 2); ?></strong></p>

        <form method="POST">
            <label>Delivery Address:</label>
            <textarea name="address" required></textarea>

            <label>Payment Method:</label>
            <select name="payment_method" required>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Mobile Money">Mobile Money</option>
            </select>

            <button type="submit">Place Order</button>
        </form>
    </div>

    <?php include 'includes/../footer.php'; ?>
</body>
</html>
