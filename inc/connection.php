<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "synerx";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}
?>