<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    include '../inc/connection.php';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Page 1 - Retrieve the choice
    $choice = isset($_POST['choice']) ? $_POST['choice'] : null;

    // Page 2, 3, 4, and 5 - Retrieve other form data
    $input1 = isset($_POST['input1']) ? $_POST['input1'] : null;
    $input2 = isset($_POST['input2']) ? $_POST['input2'] : null;

    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $contact = isset($_POST['contact']) ? $_POST['contact'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    $address = isset($_POST['address']) ? $_POST['address'] : null;

    $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : null;
    $bankInfo = isset($_POST['bankInfo']) ? $_POST['bankInfo'] : null;

    // Insert data into the database table
    $sql = "INSERT INTO purchase (choice, input1, input2, name, contact, email, address, payment_method, bank_info)
            VALUES ('$choice', '$input1', '$input2', '$name', '$contact', '$email', '$address', '$paymentMethod', '$bankInfo')";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
