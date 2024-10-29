<html>
<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TABLE ADMIN</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .body {
            background: #232d57;
        }
        .input {
            padding: 10px;
            text-align: center;
            /*display: flex;*/
            margin-left: 100px;
        }
        .input1{
            padding: 10px; 
            text-align: center;
            display: flex;
            margin-left: 45%;
        }
        .input2{
            padding: 10px; 
            text-align: center;
            display: flex;
            margin-left: 43%;
        }
    </style>
</head>
<body>

    <?php
    // Create connection to db
    $conn = new mysqli("localhost", "root", "", "table");

    // Check conn to db
    if ($conn->connect_error) {
        die("COULD NOT CONNECT TO THE DATABASE: " . $conn->connect_error);
    }

    // Check form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form fields are set
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $fruit = isset($_POST['fruit']) ? $_POST['fruit'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';

        // Checking for empty conditions
        if ($fruit == '' || $price == '') {
            echo "<script>alert('Please fill all the available fields.');</script>";
        } else {


            //check if same data is there
            $checkSql = "SELECT * FROM fruit_table WHERE Id='$id'";
            $checkResult = $conn->query($checkSql);
            //check if id already exists
            if ($checkResult && $checkResult->num_rows > 0) {
                // ID already exists
                
                echo " <script>alert('ID already exists. Please enter a unique ID. ' );</script>";
                
            } else {


            // Insert data into fruit table
            $sql = "INSERT INTO fruit_table (Id, Fruit, Price) VALUES ('$id', '$fruit', '$price')";
            $result = $conn->query($sql);

            


            if ($result) {
                echo "<script>alert('Record successfully added');</script>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        }
    }
}

    // Fetch records from the fruit table
    $sql = "SELECT * FROM fruit_table"; // Make sure the table name is correct
    $result = $conn->query($sql);
    ?>

    <form action="" method="post" class="input" style="font-size: 1.6rem; color:cyan">
        <!-- Form to Enter Data -->
        <label for="id">Id:</label>
        <input type="number" name="id" id="id" style="font-size: 1.6rem;" placeholder="Enter Id No" autocomplete="off" required>
        <label for="fruit">Fruit:</label>
        <input type="text" name="fruit" id="fruit" style="font-size: 1.6rem;" placeholder="Enter Fruit Name" autocomplete="off" required>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" style="font-size: 1.6rem;" placeholder="Enter price" autocomplete="off" required>
        <button style="border-radius: 20px; margin-left: 10%;"><a class="nav-link" href="fruit_table.php" style="font-size: 1.4rem; text-decoration: none;">Home</a></button><br><br>
        <input type="submit" value="Submit" style="font-size: 1.6rem; margin: 10px; margin-right: 150px;">
        
        
    </form>
    <form action="" method="post" class="input1">
    
    </form>
    <form action="" method="post" class="input2">
        
        <button style="border-radius: 20px;"><a class="nav-link" href="edit.php" style="font-size: 1.4rem; text-decoration: none;">EDIT TABLES</a></button>
        </form>
    <table>
    <thead>
        <tr>
            <td colspan="3" style="background: #878239 ;"><h3>
                <marquee behavior="" direction="">Fruits Table</marquee>
            </h3></td>
        </tr>
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
                        <td>" . $id=$row['id']. "</td>
                        <td>" . htmlspecialchars($row["fruit"]) . "</td>
                        <td>" . htmlspecialchars($row["price"]) . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

        </tbody>
    </table>

     
   
        
</body>
</html>
