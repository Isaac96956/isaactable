<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT TABLE</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: url(images/colors4.webp);
            background-size: cover;
        }
        .input {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <?php
    // Create connection to the database
    $conn = new mysqli("localhost", "root", "", "table");

    // Check connection
    if ($conn->connect_error) {
        die("COULD NOT CONNECT TO THE DATABASE: " . $conn->connect_error);
    }

    // Initialize variables for editing
    $edit_id = '';
    $edit_fruit = '';
    $edit_price = '';

    // Check form submission for insert or update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if we are editing
        if (isset($_POST['edit_id']) && $_POST['edit_id'] !== '') {
            // Update record
            $edit_id = $_POST['edit_id'];
            $id = $_POST['id'];
            $fruit = $_POST['fruit'];
            $price = $_POST['price'];

            $sql = "UPDATE fruit_table SET fruit='$fruit', price='$price' WHERE Id='$edit_id'";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Record successfully updated');</script>";
                echo "<meta http-equiv='refresh' content='0'>"; // Refresh the page
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        } elseif (isset($_POST['id'], $_POST['fruit'], $_POST['price'])) {
            // Insert new record
            $id = $_POST['id'];
            $fruit = $_POST['fruit'];
            $price = $_POST['price'];

            if ($id === '' || $fruit === '' || $price === '') {
                echo "<script>alert('Please fill all the available fields.');</script>";
            } else {
                $sql = "INSERT INTO fruit_table (Id, Fruit, Price) VALUES ('$id', '$fruit', '$price')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Record successfully added');</script>";
                    echo "<meta http-equiv='refresh' content='0'>"; // Refresh the page
                } else {
                    echo "<p>Error: " . $conn->error . "</p>";
                }
            }
        }
    }

    // Fetch records from the fruit table
    $sql = "SELECT * FROM fruit_table";
    $result = $conn->query($sql);

    // Check if an edit request was sent
    // Check if an edit request was sent
if (isset($_POST['edit_request_id'])) {
    $edit_id = $_POST['edit_request_id'];
    $sql = "SELECT * FROM fruit_table WHERE Id='$edit_id'";
    $edit_result = $conn->query($sql);
    if ($edit_result->num_rows > 0) {
        $row = $edit_result->fetch_assoc();
        $edit_id = $row['id'];  // Use value from the fetched row
        $edit_fruit = $row['fruit'];
        $edit_price = $row['price'];
    }
}
    ?>

    <form action="" method="post" class="input" style="font-size: 1.6rem;">
        <!-- Form to Enter or Edit Data -->
        
        <label for="fruit">Fruit:</label>
        <input type="text" name="fruit" id="fruit" value="<?php echo htmlspecialchars($edit_fruit); ?>" style="font-size: 1.6rem;" required><br><br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($edit_price); ?>" style="font-size: 1.6rem;" required><br><br>
        <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
        <input type="submit" value="Update" style="font-size: 1.6rem;"><br><br>
        <!-- <input type="submit" value="<?php echo $edit_id ? 'Update' : 'Submit'; ?>" style="font-size: 1.6rem;"><br><br> -->
        <button style="border-radius: 20px;"><a class="nav-link" href="index.php" style="font-size: 1.4rem; text-decoration: none;">Add New</a></button>
    </form>

    
    <table border="1" class="input1" style="width: 50%; font-size: 1.3rem;">
    <tr>
    <td colspan="4" style="background: #464328 ; color: red;"><h4>
        <marquee behavior="" direction="">Fruit List</marquee>
    </h4></td>
    </tr>
        <tr>
            <th>ID</th>
            <th>Fruit</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['fruit']); ?></td>
                    <td><?php echo htmlspecialchars($row['price']); ?></td>
                    <td>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="edit_request_id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Edit">
                        </form>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this record?');">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No records found</td>
            </tr>
        <?php endif; ?>
    </table>

    <?php
    // Handle deletion
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];
        $sql = "DELETE FROM fruit_table WHERE Id='$delete_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Record successfully deleted');</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
