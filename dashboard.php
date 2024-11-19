// dashboard.php
<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$department_id = $_SESSION['department_id'];

// Retrieve documents for the user's department
$sql = "SELECT title, file_path FROM documents WHERE department_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h1>Documents for Your Department</h1>";

while ($row = $result->fetch_assoc()) {
    echo "<p><a href='" . htmlspecialchars($row['file_path']) . "'>" . htmlspecialchars($row['title']) . "</a></p>";
}

$stmt->close();
$conn->close();
?>
