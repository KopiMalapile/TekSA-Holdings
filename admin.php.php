// admin/upload.php
<?php
session_start();
include 'connection.php';

// Check if the user is an admin
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $department_id = $_POST['department'];
    $file = $_FILES['file'];

    // Validate inputs
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $department_id = (int)$department_id;

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $target_file);

    // Insert document info into database
    $sql = "INSERT INTO documents (title, file_path, department_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $target_file, $department_id);
    $stmt->execute();

    echo "Document uploaded successfully.";
    $stmt->close();
}
$conn->close();
?>
    