<?php
    if (isset($_POST['signup'])) {
        // Database connection details
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPass = 'root';
        $dbName = 's1';

        // Create a database connection
        $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

        // Check for a successful connection
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // Retrieve user input
        $username =  $_POST['username'];
        $email =, $_POST['email'];
        $password = $_POST['password'];

        // Hash the password (for security)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $query)) {
            echo '<p>Registration successful. You can now <a href="login.php">log in</a>.</p>';
        } else {
            echo '<p>Registration failed. Please try again.</p>';
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>