<?php
include "connect_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the email and username keys exist in the $_POST array
    if (isset($_POST['email']) && isset($_POST['username'])) {
        $email = $conn->real_escape_string($_POST['email']); // Sanitize input
        $username = $conn->real_escape_string($_POST['username']); // Sanitize input

        // Check if the username exists in the database
        $checkSql = "SELECT email FROM user WHERE email='$email' AND username='$username'"; // Corrected SQL syntax
        $result = $conn->query($checkSql);

        if ($result && $result->num_rows > 0) {
            // Fetch the user's email
            $user = $result->fetch_assoc();
            $email = $user['email'];

            // Generate a unique password reset token
            $token = bin2hex(random_bytes(50)); // Generate a random token
            $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token; // Create a reset link

            // Here you should send the email with the reset link
            // Example: mail($email, "Password Reset", "Click this link to reset your password: $resetLink");
            $subject = "Password Reset";
$message = "Click this link to reset your password: $resetLink";
$headers = "From: no-reply@yourwebsite.com\r\n";
$headers .= "Reply-To: no-reply@yourwebsite.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($email, $subject, $message, $headers)) {
    echo "<script>alert('Password reset link sent to your email.');</script>";
} else {
    echo "<script>alert('Failed to send email.');</script>";
}


            echo "<script>alert('Password reset link sent to your email.');</script>";
        } else {
            echo "<script>alert('Username or email not found.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in both fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form method="POST">
        <h2>Forgot Password</h2>
        <input type="text" name="email" placeholder="Email" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="submit" value="Reset Password">
        <button class="login1"><a style="text-decoration: none; color:#fff" href="login.php">Login</a></button>
    </form>
</body>
</html>