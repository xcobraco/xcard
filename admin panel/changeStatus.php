<?php
include '../inc/connection.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

if (isset($_GET['id'])) {
    $changeId = $_GET['id'];

    // Create connection if not already established
    if (!isset($conn)) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }

    // Perform the delete operation
    $deleteSql = "UPDATE contact SET Status = 'Done' WHERE CID = $changeId";

    if ($conn->query($deleteSql) === TRUE) {
        echo '<script>alert("Record updated successfully");</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close connection
    $conn->close();

    header("Location: cusReqs.php"); // Redirect back to the table page after deletion
    exit();
} else {
    echo "Invalid request. User ID not provided.";
}

// Close connection (this should also be done outside the if block)
if (isset($conn)) {
    $conn->close();
}
?>
