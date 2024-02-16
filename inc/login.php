<?php
// PHP code for handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include '../inc/connection.php';

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $enteredUsername = $_POST["username"];
    $enteredPassword = $_POST["password"];

    // Query to check user credentials
    $sql = "SELECT * FROM admin WHERE username = '$enteredUsername' AND password = '$enteredPassword'";
    $result = $conn->query($sql);

    // Check if the query returned a row (valid credentials)
    if ($result->num_rows > 0) {
        // Redirect to home.php
        session_start(); // Start the session
        $_SESSION['username'] = $enteredUsername; // Store the username in the session variable
        header("Location: ../admin panel/home.php");
        exit();
    } else {
        // Display error message for invalid credentials
        echo '<script>alert("Invalid username or password");</script>';
        echo '<script>window.location.href = "../index.html";</script>';
    }

    $conn->close();
}
?>
