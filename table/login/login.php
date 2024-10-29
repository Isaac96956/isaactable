<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <link rel="stylesheet" href="login.css">
</head>
<body>
    
<form action="log_in.php" method="post">
<h2>LOGIN</h2><br>
    <?php
    if (isset($_GET['error'])){
    echo '<p class="error">' .$_GET['error'] .'</p>';
    }
    ?>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="Username" autocomplete="on">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Password" autocomplete="new-password">
    <button type="submit">Login</button>
    <label for="forgot_password"><a href="forgot_password.php">Forgot Password</a></label>
    <label for="sign up"><p>Create a new account? <a href="sign_up.php">Sign up</a></p> </label>
    
</form>
</body>
</html>