<?php
session_start();
include "connect_db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);


        // Checking for empty conditions
        if ($email == ''or $username == '' || $password == '') {
            echo "<script>alert('Please fill all the available fields.');</script>";
        } else {


            //check if same data is there
            $checkSql = "SELECT * FROM user WHERE email='$email'";
            $checkResult = $conn->query($checkSql);
            //check if id already exists
            if ($checkResult && $checkResult->num_rows > 0) {
                // ID already exists
                
                echo " <script>alert('Email already exists. Enter different email. ' );</script>";
                
                
            } else {


            // Insert data into fruit table
            $sql = "INSERT INTO user (email, username, password ) VALUES ('$email', '$username', '$password')";
            $result = $conn->query($sql);

            


            if ($result) {
                echo "<script>alert('Signed successfuly');</script>";

                
               
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        }
    }
}

    // Fetch records from the fruit table
    $sql = "SELECT * FROM user"; // Make sure the table name is correct
    $result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
<link rel="stylesheet" href="login.css">
</head>
<style>
    
</style>
<body>
    <form action="" method="post">
    <h2>Sign Up</h2>
        <label for="email">E-mail</label>
        <input type="text" name="email" placeholder="E-mail" required>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" autocomplete="off" required>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" autocomplete="new-password" required>
        <input type="submit" value="Sign Up">
        <button class="login"><a style="text-decoration: none; color:#fff" href="login.php">Login</a></button>
    </form>
</body>
</html>