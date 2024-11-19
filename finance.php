<?php
session_start();
include 'db.php'; // Ensure this file connects to your database

if (!isset($_SESSION['user_id']) || $_SESSION['department_id'] != 2) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Department</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Finance Dashboard</h1>
        <p>Welcome to Finance!</p>
        <!-- Add Finance-specific content here -->

        <div class="register-link">
            <p><a href="upload.html">Upload Document</a></p>
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>
</body>
</html>
