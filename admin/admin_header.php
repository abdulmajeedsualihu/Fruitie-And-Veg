<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_header.css">
    <header class="admin-header">
        <h1 style="color: white">Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin.php">🏠 Dashboard</a></li>
                <li><a href="manage_products.php">🍏 Manage Products</a></li>
                <li><a href="manage_users.php">👥 Manage Users</a></li>
                <li><a href="admin_logout.php" class="logout-btn" style="color: #219150">🚪 Logout</a></li>
            </ul>
        </nav>
    </header>
