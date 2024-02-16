<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection parameters
     include '../inc/connection.php';

    // Create a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $choice = $_POST["userPreference"];
    $name = $_POST["name"];
    $company = $_POST["company"];
    $position = $_POST["position"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $slipemail = $_POST["emailSlip"];
    $label = $_POST["coupon"];
    $paytype = $_POST["paymentMethod"];

    // Upload files
    $uploadDir = "uploads/";

    // Handle logo upload
    if (isset($_FILES["logo"]["name"])) {
        $logo = $_FILES["logo"]["name"];
        move_uploaded_file($_FILES["logo"]["tmp_name"], $uploadDir . $logo);
    } else {
        $logo = "-";
    }

    // Handle design upload
    if (isset($_FILES["design"]["name"])) {
        $design = $_FILES["design"]["name"];
        move_uploaded_file($_FILES["design"]["tmp_name"], $uploadDir . $design);
    } else {
        $design = "-";
    }

    // Handle payment slip upload
    if (isset($_FILES["paymentSlip"]["name"])) {
        $paymentSlip = $_FILES["paymentSlip"]["name"];
        move_uploaded_file($_FILES["paymentSlip"]["tmp_name"], $uploadDir . $paymentSlip);
    } else {
        $paymentSlip = "-";
    }

    // Insert data into the MySQL database
  $sql = "INSERT INTO purchase(choice, company, position, logo, label, name, contact, email, design, address, slipEmail, payType, payslip, couponCode, Status) 
        VALUES ('$choice', '$company', '$position', '$logo', '$label', '$name', '$contact', '$email', '$design', '$address', '$slipemail', '$paytype', '$paymentSlip', '$label', 'Pending')";


 if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Order placed successfully!"); window.location.href="http://synerx.lk";</script>';
} else {
    echo '<script>alert("Error: ' . addslashes($conn->error) . '");</script>';
}


    // Close the database connection
    $conn->close();
}
?>
