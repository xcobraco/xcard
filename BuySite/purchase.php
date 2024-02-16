<?php
include '../inc/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $choice = $_POST["choice"];
    $input1 = $_POST["input1"];
    $input2 = $_POST["input2"];
    // Add more variables for other form fields as needed

    // Prepare SQL statement
    $sql = "INSERT INTO purchase (choice, input1, input2) VALUES ('$choice', '$input1', '$input2')";
    // Add more columns/values in the SQL statement as needed

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Done");</script>';
    } else {
        echo '<script>showErrorAlert();</script>';
    }
}

// Close the connection
$conn->close();
?>