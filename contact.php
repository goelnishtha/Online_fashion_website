<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
</head>
<body>
    <h2>Contact Us</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        
        <label for="message">Message:</label>
        <textarea name="message" id="message" required></textarea><br><br>
        
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve user input from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create a new PDO instance for database connection
    $dsn = 'mysql:host=localhost;dbname=trendify';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);

        // Define and prepare the SQL statement to insert data into the table
        $sql = "INSERT INTO contact_submissions (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Execute the query
        if ($stmt->execute()) {
            echo "<h3>Contact Form Data Saved to Database Successfully!</h3>";
        } else {
            echo "<h3>Error Saving Data to Database</h3>";
        }

        // Close the database connection
        $pdo = null;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

</body>
</html>
