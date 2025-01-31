<?php
session_start();
include 'includes/../../db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Fetch user orders
$order_sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$order_result = $conn->query($order_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);

    $update_sql = "UPDATE users SET name='$name', email='$email', address='$address' WHERE user_id='$user_id'";
    
    if ($conn->query($update_sql)) {
        echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="./profile.css">
</head>
<body>

<?php include 'includes/../header.php'; ?>

<div class="profile-container">
    <h2>Your Profile</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Address:</label>
        <textarea name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>

        <button type="submit">Update Profile</button>
    </form>

    <h2>Order History</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $order_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><a href="tracker.php?order_id=<?php echo $order['order_id']; ?>" class="btn">Track Order</a></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<?php include 'includes/../footer.php'; ?>

</body>
</html>
