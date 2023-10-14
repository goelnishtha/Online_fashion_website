<!DOCTYPE html>
<html lang="en">
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
    <div class="login-container" method="Post" action="login.php">
    <h2>Login</h2>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        
        <input type="submit" name="submit" value="Login">
        
    </form>
    <p>DO NOT HAVE ACCOUNT?</p>
        <a href="new.php"><button>Sign Up</button></a>
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
        $password = $_POST['password'];

        // Create a database connection
        $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Check for a connection error
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to retrieve user data
        $sql = "SELECT * FROM users WHERE username='$username'";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // User exists, check the password
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) {
                // Passwords match, redirect to a welcome page
                header("Location: about.html");
                exit();
            } else {
                // Display an error message if the password is incorrect
                echo "Invalid username or password. Please try again.";
            }
        } else {
            // Display an error message if the username is not found
            echo "Invalid username or password. Please try again.";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
</body>
</html>
