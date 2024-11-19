// login.php
<?php
session_start();
include 'connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate and sanitize inputs
    $username = filter_var($username, FILTER_SANITIZE_STRING);

    // Check if user exists
    $sql = "SELECT id, password_hash, department_id FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password_hash, $department_id);
        $stmt->fetch();
        
        // Verify password
        if (password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['department_id'] = $department_id;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid credentials.";
        }
    } else {
        echo "User not found.";
    }
    $stmt->close();
}
$conn->close();
?>
