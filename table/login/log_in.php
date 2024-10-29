<html style="background-color: bisque;">
<style>
    a {
        float: right;
        background: #555;
        padding: 10px 14px;
        color: #fff;
        border-radius: 5px;
        margin-right: 10px;
        border: none;
        text-decoration: none;
    }
    a:hover {
        opacity: 0.7;
    }
</style>

<?php
session_start();
include "connect_db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // Validate input fields
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = validate($_POST['username']);
        $password = validate($_POST['password']);
    
        if (empty($username)) {
            header("location: login.php?error=Username is required");
            exit();
        } elseif (empty($password)) {
            header("location: login.php?error=Password is required");
            exit();
        } else {
            // Use prepared statements to prevent SQL injection
            $sql = "SELECT * FROM user WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username); // Bind the username parameter
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                
                // Check if the password is correct
                if (password_verify($password, $row['password'])) { // Verify the hashed password
                    $_SESSION['username'] = $row['username'];
                    header("location: /table/fruit_table.php"); // Redirect to another page
                    exit();
                } else {
                    header("location: login.php?error=Incorrect username or password");
                    exit();
                }
            } else {
                header("location: login.php?error=Incorrect username or password");
                exit();
            }
        }
    } else {
        header("location: login.php?error=Please fill in all fields");
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>
</html>
