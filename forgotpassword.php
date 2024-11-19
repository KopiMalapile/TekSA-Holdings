<?php
session_start();
include 'connection.php'; // Include your database connection file

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Sanitize email input
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email exists in the users table
        $sql = "SELECT email FROM users WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Generate a unique token
            $token = bin2hex(random_bytes(50));
            
            // Store the token in the password_resets table
            $sql = "INSERT INTO password_resets (email, token) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $token);
            $stmt->execute();
            
            // Send a password reset email
            $reset_link = "http://yourwebsite.com/resetpassword.php?token=" . $token;
            $subject = "Password Reset Request";
            $message = "Please click the link below to reset your password:\n\n" . $reset_link;
            $headers = "From: no-reply@yourwebsite.com\r\n";
            
            if (mail($email, $subject, $message, $headers)) {
                echo "A password reset link has been sent to your email.";
            } else {
                echo "Failed to send email. Please try again later.";
            }
        } else {
            echo "No account found with that email address.";
        }

        $stmt->close();
    } else {
        echo "Invalid email address.";
    }
}

$conn->close();
?>
