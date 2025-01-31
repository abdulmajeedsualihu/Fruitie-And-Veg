<?php
session_start();
include 'includes/../../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all orders for the logged-in user
$sql = "SELECT * FROM orders WHERE user_id = " . $_SESSION['user_id'];
$result = $conn->query($sql);
$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$order = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_number = $_POST['order_number'];
    $sql = "SELECT * FROM orders WHERE order_number = '$order_number' AND user_id = " . $_SESSION['user_id'];
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        $error = "No order found with this Order ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order</title>
    <link rel="stylesheet" href="../user/tracker.css">
</head>
<body>
    <?php include 'includes/../header.php'; ?>

    <div class="container">
        <h1>Track Your Order</h1>
        <form action="tracker.php" method="POST">
            <input type="text" name="order_number" placeholder="Enter Order ID" required>
            <button type="submit">Track Order</button>
        </form>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($order): ?>
            <div class="order-details">
                <h2>Order Details</h2>
                <p><strong>Order ID:</strong> <?php echo $order['order_number']; ?></p>
                <p><strong>Status:</strong> <?php echo $order['status']; ?></p>
                <p><strong>Total Price:</strong> $<?php echo $order['total_price']; ?></p>
                <p><strong>Ordered On:</strong> <?php echo $order['created_at']; ?></p>
                <p><strong>Expected Delivery:</strong> <?php echo $order['expected_delivery']; ?></p>
            </div>
        <?php endif; ?>

        <!-- Display all orders -->
        <h2>Your Previous Orders</h2>
        <?php if (count($orders) > 0): ?>
            <table class="order-list">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Ordered On</th>
                        <th>Expected Delivery</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $o): ?>
                        <tr>
                            <td><?php echo $o['order_number']; ?></td>
                            <td><?php echo $o['status']; ?></td>
                            <td>$<?php echo $o['total_price']; ?></td>
                            <td><?php echo $o['created_at']; ?></td>
                            <td><?php echo $o['expected_delivery']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No previous orders found.</p>
        <?php endif; ?>
    </div>

    <?php include 'includes/../footer.php'; ?>
</body>
</html>
