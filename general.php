<?php
session_start();
include 'connection.php'; // Ensure this file connects to your database

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Dashboard</h1>
        <p>Welcome to document drive!</p>
        <!-- Add default content here -->

        <div class="register-link">
            <p><a href="upload.html">Upload Document</a></p>
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>
