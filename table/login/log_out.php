<?php

// Start session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();

// Optional: Add a message for debugging purposes
session_start();
session_unset();
session_destroy();

echo "You have been logged out."; // Uncomment for debugging

// Redirect to login page
header("Location: login.php");
exit(); // Ensure no further code is executed after the redirection


?>