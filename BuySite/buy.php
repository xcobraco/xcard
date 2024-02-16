<?php
// Enable error reporting for debugging (turn this off in a production environment)
error_reporting(E_ALL);

// Database credentials
include '../inc/connection.php';

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect POST data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $company = $_POST['company'];
    $phone = $_POST['phone'];
    $paymentType = $_POST['paymentType'];
    $cardType = $_POST['cardType'];

    // Initialize variables for file upload
    $uploadedLogoName = '';

    // Handle logo file upload
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
        $fileTmpPath = $_FILES['logo']['tmp_name'];
        $fileName = $_FILES['logo']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = 'uploaded_files/';

        // Ensure the upload directory exists
        if (!file_exists($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $uploadedLogoName = $newFileName;
        } else {
            echo "Error uploading file";
        }
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO orders (name, email, position, company, phone, payment_type, card_type, logo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $position, $company, $phone, $paymentType, $cardType, $uploadedLogoName);

    // Execute and check for errors
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
