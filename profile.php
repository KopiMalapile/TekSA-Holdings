<?php
session_start();
include 'connection.php'; // Ensure this file contains your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit();
}

// Retrieve the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Prepare and execute SQL query to fetch user data
$sql = "SELECT username, email, profile_picture FROM users WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user data
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css"> <!-- Ensure this CSS file is correctly linked -->
</head>
<body>
    <div class="wrapper">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
        <div class="profile-info">
            <?php if ($user['profile_picture']): ?>
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture">
            <?php else: ?>
                <img src="default-profile.png" alt="Default Profile Picture">
            <?php endif; ?>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</body>
</html>
