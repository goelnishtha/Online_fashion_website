<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style5.css">
    <title>Login - Trendify</title>
</head>
<body>
    <header>
        <h1 class="logo">Trendify</h1>
        <nav>
            <ul class="menu">
                <li><a href="index.html">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="Product.html">Product</a></li>
                <li><a href="Contact.html">Contact</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="login-container">
    <h2>Sign Up</h2>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" name="submit" value="Sign Up">
    </form>
    </div>

    <?php
    // Database connection parameters
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "trendify";

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve user input from the form
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Create a database connection
        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Check for a connection error
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the username already exists
        $check_query = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // Display an error message if the username is already taken
            echo "Username already exists. Please choose another username.";
        } else {
            // Insert new user data into the database
            $insert_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

            if ($conn->query($insert_query) === TRUE) {
                // Registration successful, redirect to a welcome page
                header("Location: login.php");
                exit();
            } else {
                // Display an error message if there's a problem with the database query
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>
</html>
