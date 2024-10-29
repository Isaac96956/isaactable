<?php
// Create a connection to the database
$con = mysqli_connect('localhost', 'root', '', 'table');
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch records from the fruit table
$result = mysqli_query($con, "SELECT * FROM fruit_table"); // Ensure your table name is correct
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruits Table</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<button style="padding: 6px 4px;
    float: right;
    margin-top: 10px;">
<a href="login/log_out.php" style="text-decoration:none; color:black;">Log out</a>
</button>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fruit</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $id=$row["id"] . "</td>
                        <td>" . htmlspecialchars($row["fruit"]) . "</td>
                        <td>" . htmlspecialchars($row["price"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }

        // Close the database connection
        mysqli_close($con);
        ?>
    </tbody>
</table>

<button class="btn" style="border-radius: 20px;"><a class="link" href="index.php" style="text-decoration:none; color:black;">
    <marquee behavior="" direction="">Add New</marquee>
</a></button>


</body>
</html>
