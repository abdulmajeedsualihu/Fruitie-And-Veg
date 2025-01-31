<?php
// Check if session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include 'includes/../../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['user_name'];
    $email = $_POST['email'];
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO feedback (user_id, name, email, message) VALUES ('$user_id', '$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Feedback submitted successfully!'); window.location='feedback.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="user/feedback.css">
</head>
<body>

    <div class="container">
        <h1>Customer Feedback</h1>
        <form action="./user/feedback.php" method="POST">
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Write your feedback..." required></textarea>
            <button type="submit">Submit Feedback</button>
        </form>

        <h2>What Customers Say</h2>
        <div class="feedback-list">
            <?php
            $sql = "SELECT * FROM feedback ORDER BY created_at DESC";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<div class='feedback-card'>
                        <h3>" . htmlspecialchars($row['name']) . "</h3>
                        <p>" . htmlspecialchars($row['message']) . "</p>
                        <small>Posted on: " . $row['created_at'] . "</small>
                      </div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
